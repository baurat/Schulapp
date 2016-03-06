<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VertretungsplanController extends Controller {

    protected $vertretungsplan1;
    protected $vertretungsplan2;
    protected $lehrer1;
    protected $lehrer2;
    protected $speiseplan;

    /**
     * @Route("/schueler", name="schueler")
     * @Route("/vertretungen", name="vertretungen")
     * @Route("/vertretungsplan", name="vertretungsplan")
     */
    public function indexAction(Request $request) {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Keine Berechtigung für diese Seite!');
        $user = $this->getUser();
        $layout = 'vertretungsplan/layouts/layout1.html.twig';

        if (in_array('ROLE_TEACHER', $user->getRoles())) {
            $this->prepareLehrerVertretungsplaene();
        } else {
            $this->prepareVertretungsplaene();
        }

        return $this->render('vertretungsplan/vertretungsplan.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
                    'vertretungen_1' => $this->vertretungsplan1,
                    'vertretungen_2' => $this->vertretungsplan2,
                    'lehrervertretungen_1' => $this->lehrer1,
                    'lehrervertretungen_2' => $this->lehrer2,
                    'speiseplan' => $this->speiseplan,
                    'meldungen' => $this->getMeldungen(),
                    'std' => $this->getAktuelleStunde(),
                    'user' => $user,
                    'layout' => $layout,
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
                ->orderBy('v.klasse')
                ->addOrderBy('CAST(v.klasse AS UNSIGNED)')
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
     * Holt die Datenbankeinträge des Vertretungsplans.
     * @param String $day Ein in englischer Textform angegebenes Datum, z.B. 'today', 'next monday'.
     * @param String $lehrkraft Die Lehrkraft
     * @return Entity:Vertretungsplan Ein Vertretungsplan-Objekt mit Daten aus der Datenbank.
     */
    public function getLehrerVertretungen($day = 'today', $lehrkraft = null) {
        $date = \date('Y-m-d', strtotime($day));

        $repository = $this->getDoctrine()->getRepository('AppBundle:Lehrervertretung');

        $query = $repository->createQueryBuilder('v')
                ->where('v.datum = :datum')
                ->andWhere('v.stunde >= :stunde')
                ->orderBy('v.lehrkraft')
                ->addOrderBy('CAST(v.klasse AS UNSIGNED)')
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

        if ($lehrkraft !== null) {
            $query = $repository->andWhere('v.lehrkraft = :lehrkraft')->setParameter('lehrkraft', $lehrkraft);
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
                $this->speiseplan = $this->getSpeiseplan();
                break;
            case 6:
            case 0:
                $this->vertretungsplan1 = $this->getVertretungen('next monday');
                $this->vertretungsplan2 = $this->getVertretungen('next tuesday');
                $this->speiseplan = $this->getSpeiseplan('next monday');
                break;
            default:
                $this->vertretungsplan1 = $this->getVertretungen();
                $this->vertretungsplan2 = $this->getVertretungen('tomorrow');
                $this->speiseplan = $this->getSpeiseplan();
                break;
        }
    }
    
    /**
     * Plan-Logik: Ist heute normaler Werktag, Freitag oder Wochenende?
     * Speichert die Vertretungsplan-Objekte in die Variablen.
     */
    public function prepareLehrerVertretungsplaene() {
        switch (\date('w', strtotime('today'))) {
            case 5:
                $this->lehrer1 = $this->getLehrerVertretungen();
                $this->lehrer2 = $this->getLehrerVertretungen('next monday');
                $this->speiseplan = $this->getSpeiseplan();
                break;
            case 6:
            case 0:
                $this->lehrer1 = $this->getLehrerVertretungen('next monday');
                $this->lehrer2 = $this->getLehrerVertretungen('next tuesday');
                $this->speiseplan = $this->getSpeiseplan('next monday');
                break;
            default:
                $this->lehrer1 = $this->getLehrerVertretungen();
                $this->lehrer2 = $this->getLehrerVertretungen('tomorrow');
                $this->speiseplan = $this->getSpeiseplan();
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

        //var_dump((int)$aktuelleStunde->getStunde()); die;
        return (int) $aktuelleStunde->getStunde();
    }

    public function getSpeiseplan($day = 'this monday') {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Speiseplan');
        $kw = \date('W', strtotime($day));

        $query = $repository->createQueryBuilder('s')
                ->where('s.kalenderwoche = :kw')
                ->setParameter('kw', $kw)
                ->orderBy('s.id')
                ->getQuery();

        return $query->getResult();
    }

    public function getMeldungen($day = 'today', $fuer_lehrer = 0) {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Meldung');
        $date = \date('Y-m-d', strtotime($day));

        $query = $repository->createQueryBuilder('m')
                ->where('m.start_datum >= :dd')
                ->andWhere('m.end_datum <= :dd')
                ->andWhere('m.fuer_lehrer = :lehrer')
                ->setParameter('dd', $date)
                ->setParameter('lehrer', $fuer_lehrer)
                ->orderBy('m.id')
                ->getQuery();

        return $query->getResult();
    }

}
