<?php

namespace Hleco\DemoBundle\Controller;

use Hleco\DemoBundle\Form\Type\TaskType;
use Hleco\DemoBundle\Model\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(
            new TaskType(),
            new Task(),
            array(
                'action' => $this->generateUrl('homepage'),
                'method' => 'POST',
            )
        );

        $form->handleRequest($request);
        if ($form->isValid()) {
            return $this->redirect($this->generateUrl('homepage'));
        }

        return array(
            'form' => $form->createView(),
        );
    }
}
