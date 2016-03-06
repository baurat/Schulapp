<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StartscreenController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Keine Berechtigung für diese Seite!');
        $user = $this->getUser();

        return $this->render('startscreen/startscreen.html.twig', [
                    'user' => $user,
                    'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
        ]);
    }

}
