<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VertretungsplanController extends Controller {

    protected $vertretungsplan1;
    protected $vertretungsplan2;

    /**
     * @Route("/schueler", name="schueler")
     */
    public function indexAction(Request $request) {
        $this->prepareVertretungsplaene();

        return $this->render('vertretungsplan/schueler/index.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
                    'vertretungen_1' => $this->vertretungsplan1,
                    'vertretungen_2' => $this->vertretungsplan2,
        ]);
    }

    /**
     * Holt die Datenbankeinträge des Vertretungsplans.
     * @param String $day Ein in englischer Textform angegebenes Datum, z.B. 'today', 'next monday'.
     * @param String $klasse Die Klassenbezeichnung, z.B. 5A oder 6B. Case-sensitive!
     * @return Entity:Vertretungsplan Ein Vertretungsplan-Objekt mit Daten aus der Datenbank.
     */
    public function getVertretungen($day = 'today', $klasse = null) {
        $date = \date('Y-m-d', strtotime($day));

        $repository = $this->getDoctrine()->getRepository('AppBundle:Vertretung');

        $query = $repository->createQueryBuilder('v')
                ->where('v.datum = :datum')
                ->andWhere('v.stunde >= :stunde')
                ->orderBy('CAST(v.klasse AS UNSIGNED)')
                ->addOrderBy('v.klasse')
                ->addOrderBy('CAST(v.stunde AS UNSIGNED)')
                ->setParameter('datum', $date);
        // https://www.mpopp.net/2006/06/sorting-of-numeric-values-mixed-with-alphanumeric-values/
        
        if ($day === 'today') {
            $query->setParameter('stunde', $this->getAktuelleStunde());
        } else {
//            if($this->getAktuelleStunde() < 3.5) {
//                return null;
//            }
            $query->setParameter('stunde', 1);
        }

        if ($klasse !== null) {
            $query = $repository->andWhere('v.klasse = :klasse')->setParameter('klasse', $klasse);
        }

        return $query->getQuery()->getResult();
    }

    /**
     * Plan-Logik: Ist heute normaler Werktag, Freitag oder Wochenende?
     * Speichert die Vertretungsplan-Objekte in die Variablen.
     */
    public function prepareVertretungsplaene() {
        switch (\date('w', strtotime('today'))) {
            case 5:
                $this->vertretungsplan1 = $this->getVertretungen();
                $this->vertretungsplan2 = $this->getVertretungen('next monday');
                break;
            case 6:
            case 0:
                $this->vertretungsplan1 = $this->getVertretungen('next monday');
                $this->vertretungsplan2 = $this->getVertretungen('next tuesday');
                break;
            default:
                $this->vertretungsplan1 = $this->getVertretungen();
                $this->vertretungsplan2 = $this->getVertretungen('tomorrow');
                break;
        }
    }

    /**
     * Gleicht die Uhrzeit mit dem Stundenplan ab und gibt die entsprechende Schulstunde zurück.
     * @return int Aktuelle Schulstunde.
     */
    public function getAktuelleStunde() {
        $em = $this->getDoctrine()->getManager();
        $time = \date('H:i:s');
        $query = $em->createQuery('SELECT s '
                        . 'FROM AppBundle:Stundenplan s '
                        . 'WHERE s.start <= :now '
                        . 'AND s.ende >= :now '
                        . 'ORDER BY s.stunde ASC')
                ->setParameter('now', $time);

        $aktuelleStunde = $query->setMaxResults(1)->getOneOrNullResult();

        if (!$aktuelleStunde) {
            // Uhrzeit ist nicht im Bereich des Stundenplans (keine Schulzeit).
            return 1;
        }

        return $aktuelleStunde;
    }

}
