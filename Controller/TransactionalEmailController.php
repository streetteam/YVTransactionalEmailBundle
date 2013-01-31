<?php

namespace YV\TransactionalEmailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use YV\TransactionalEmailBundle\YVTransactionalEmailEvents;
use YV\TransactionalEmailBundle\Event\FormEvent;
use YV\TransactionalEmailBundle\Event\ResponseEvent;
use YV\TransactionalEmailBundle\Event\FilterTransactionalEmailResponseEvent;
use YV\TransactionalEmailBundle\Form\Type\TransactionalEmailTestType;

class TransactionalEmailController extends Controller
{
    public function indexAction()
    {
        $transactionalEmailManager = $this->get('yv_transactional_email.transactional_email_manager');
        $transactionalEmails = $transactionalEmailManager->getRepository()->findAll();
        
        return $this->render('YVTransactionalEmailBundle:TransactionalEmail:index.html.twig', array(
            'transactionalEmails' => $transactionalEmails
        ));
    }
    
    public function showAction(Request $request)
    {
        $transactionalEmail = $this->findOr404($request->get('id'));
        
        return $this->render('YVTransactionalEmailBundle:TransactionalEmail:show.html.twig', array(
            'transactionalEmail' => $transactionalEmail
        ));
    }    
    
    public function createAction(Request $request)
    {
        $transactionalEmailManager = $this->get('yv_transactional_email.transactional_email_manager');
        
        $form = $this->get('form.factory')->createNamed(
                $this->container->getParameter('yv_transactional_email.crud.form.name'),
                $this->container->getParameter('yv_transactional_email.crud.form.type'),
                $transactionalEmailManager->create()
        );
        
        $dispatcher = $this->container->get('event_dispatcher');

        $responseEvent = new ResponseEvent($request);
        $dispatcher->dispatch(YVTransactionalEmailEvents::TRANSACTIONAL_EMAIL_CREATE_INITIALIZE, $responseEvent);        
        
        if (null !== $responseEvent->getResponse()) {
            return $responseEvent->getResponse();
        }        
        
        if($request->isMethod('POST')) {
            $form->bind($request);
            
            if($form->isValid()) {
                $formEvent = new FormEvent($form, $request);
                $dispatcher->dispatch(YVTransactionalEmailEvents::TRANSACTIONAL_EMAIL_CREATE_SUCCESS, $formEvent);                 
                
                $transactionalEmail = $formEvent->getData();
                $transactionalEmailManager->save($transactionalEmail);
                
                if (null === $response = $formEvent->getResponse()) {
                    $response = $this->redirect($this->generateUrl('yv_transactional_email_index'));
                }

                $filterTransactionalEmailResponseEvent = new FilterTransactionalEmailResponseEvent($transactionalEmail, $request, $response);
                $dispatcher->dispatch(YVTransactionalEmailEvents::TRANSACTIONAL_EMAIL_CREATE_COMPLETED, $filterTransactionalEmailResponseEvent);

                return $response;
            }
        }
        
        return $this->render('YVTransactionalEmailBundle:TransactionalEmail:create.html.twig', array(
                'form' => $form->createView()
        ));         
    }
    
    public function updateAction(Request $request)
    {
        $transactionalEmail = $this->findOr404($request->get('id'));
        
        $form = $this->get('form.factory')->createNamed(
                $this->container->getParameter('yv_transactional_email.crud.form.name'),
                $this->container->getParameter('yv_transactional_email.crud.form.type'),
                $transactionalEmail
        );
        
        $dispatcher = $this->container->get('event_dispatcher');

        $responseEvent = new ResponseEvent($request);
        $dispatcher->dispatch(YVTransactionalEmailEvents::TRANSACTIONAL_EMAIL_UPDATE_INITIALIZE, $responseEvent);        
        
        if (null !== $responseEvent->getResponse()) {
            return $responseEvent->getResponse();
        }        
        
        if($request->isMethod('POST')) {
            $form->bind($request);
            
            if($form->isValid()) {
                $formEvent = new FormEvent($form, $request);
                $dispatcher->dispatch(YVTransactionalEmailEvents::TRANSACTIONAL_EMAIL_UPDATE_SUCCESS, $formEvent);                 
                
                $transactionalEmailManager = $this->get('yv_transactional_email.transactional_email_manager');
                
                $transactionalEmail = $formEvent->getData();
                $transactionalEmailManager->flush();
                
                if (null === $response = $formEvent->getResponse()) {
                    $response = $this->redirect($this->generateUrl('yv_transactional_email_index'));
                }

                $filterTransactionalEmailResponseEvent = new FilterTransactionalEmailResponseEvent($transactionalEmail, $request, $response);
                $dispatcher->dispatch(YVTransactionalEmailEvents::TRANSACTIONAL_EMAIL_UPDATE_COMPLETED, $filterTransactionalEmailResponseEvent);

                return $response;
            }
        }
        
        return $this->render('YVTransactionalEmailBundle:TransactionalEmail:update.html.twig', array(
                'form' => $form->createView(),
                'transactionalEmail' => $transactionalEmail
        ));         
    }    
    
    public function deleteAction(Request $request)
    {
        $transactionalEmail = $this->findOr404($request->get('id'));         

        $transactionalEmailManager = $this->get('yv_transactional_email.transactional_email_manager');
        $transactionalEmailManager->delete($transactionalEmail);
        
        return $this->redirect($this->generateUrl('yv_transactional_email_index'));
    }
    
    public function testAction(Request $request)
    {
        $transactionalEmail = $this->findOr404($request->get('id'));
        
        $form = $this->createForm(new TransactionalEmailTestType);      
        
        if($request->isMethod('POST')) {
            $form->bind($request);
            
            if($form->isValid()) {
                $data = $form->getData();
                
                $mailer = $this->get('yv_transactional_email.transactional_email_mailer');
                $mailer->composeAndSend($transactionalEmail, $data['recipient']);
                
                return $this->redirect($this->generateUrl('yv_transactional_email_index'));
            }
        }
        
        return $this->render('YVTransactionalEmailBundle:TransactionalEmail:test.html.twig', array(
                'form' => $form->createView(),
                'transactionalEmail' => $transactionalEmail
        ));         
    }    
    
    protected function findOr404($value)
    {
        $transactionalEmailManager = $this->get('yv_transactional_email.transactional_email_manager');
        $transactionalEmail = $transactionalEmailManager->getRepository()->find($value);    
        
        if($transactionalEmail === null) {
            throw $this->createNotFoundException('Transactional Email was not found.');
        }
        
        return $transactionalEmail;
    }
}
