<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VertretungsplanController extends Controller {

    /**
     * @Route("/schueler", name="schueler")
     */
    public function indexAction(Request $request) {

        // heute Freitag?
        if (\date('w', strtotime('tomorrow')) == 6) {
            $vertretungsplan_1 = $this->getVertretungen();
            $vertretungsplan_2 = $this->getVertretungen('next monday');
            // heute Samstag?
        } else if (\date('w', strtotime('today')) == 6 || \date('w', strtotime('today')) == 0) {
            $vertretungsplan_1 = $this->getVertretungen('next monday');
            $vertretungsplan_2 = $this->getVertretungen('next tuesday');
        } else {
            $vertretungsplan_1 = $this->getVertretungen();
            $vertretungsplan_2 = $this->getVertretungen('tomorrow');
        }

        return $this->render('vertretungsplan/schueler/index.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
                    'vertretungen_1' => $vertretungsplan_1,
                    'vertretungen_2' => $vertretungsplan_2
        ]);
    }

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
            // Über Schulzeit hinaus
            return 1;
        }

        return $aktuelleStunde;
    }

    public function getVertretungen($i = 'today', $klasse = null) {
        // https://www.mpopp.net/2006/06/sorting-of-numeric-values-mixed-with-alphanumeric-values/
        $em = $this->getDoctrine()->getManager();
        $day = \date('Y-m-d', strtotime($i));

        if ($klasse == null) {
            $query = $em->createQuery('SELECT v '
                            . 'FROM AppBundle:Vertretung v '
                            . 'WHERE v.datum >= :today '
                            . 'AND v.stunde >= :stunde '
                            . 'ORDER BY CAST(v.klasse AS UNSIGNED), v.klasse, CAST(v.stunde AS UNSIGNED)')
                    ->setParameter('today', $day);
        } else {
            $query = $em->createQuery('SELECT v '
                            . 'FROM AppBundle:Vertretung v '
                            . 'WHERE v.datum >= :today '
                            . 'AND v.stunde >= :stunde '
                            . 'AND v.klasse = :klasse '
                            . 'ORDER BY CAST(v.klasse AS UNSIGNED), v.klasse, CAST(v.stunde AS UNSIGNED)')
                    ->setParameter('today', $day)
                    ->setParameter('klasse', $klasse);
        }

        if ($i == 'today') {
            $query->setParameter('stunde', $this->getAktuelleStunde());
        } else {
            $query->setParameter('stunde', 1);
        }

        $vertretungen = $query->getResult();

        return $vertretungen;
    }

}
