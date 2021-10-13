<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Form\DevisType;
use App\Repository\ArticleRepository;
use http\Message\Body;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Message;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(Request $request, ArticleRepository $articleRepository, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->sendMail($form, $mailer);

            return $this->redirectToRoute('confirm2');

        }
        $articles = $articleRepository->findAllWithJoin();
        return $this->render('main/index.html.twig', [
            'articles' => $articles,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/expert-en-diagnostic-immobilier", name="expert_en_diagnostic_immobilier")
     */
    public function about(Request $request, MailerInterface $mailer): Response

    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->sendMail($form, $mailer);
            return $this->redirectToRoute('confirm2');
        }

        return $this->render('main/expert-en-diagnostic-immobilier.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/diagnostics-immobiliers", name="diagnostics_immobiliers")
     */
    public function diagnosticsImmobiliers(Request $request, MailerInterface $mailer): Response
    {

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->sendMail($form, $mailer);
            return $this->redirectToRoute('confirm2');
        }
        return $this->render('main/diagnostics-immobiliers.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contactez-nous", name="contactez_nous")
     */
    public function contactezNous(Request $request, MailerInterface $mailer): Response
    {

        $formDevis = $this->createForm(DevisType::class);
        $formDevis->handleRequest($request);
        if ($formDevis->isSubmitted() && $formDevis->isValid()) {
            $message = 'aucun message';
            $venteOuLoc = $formDevis->get('venteouloc')->getData();
            $typeDeBien = $formDevis->get('typeDeBien')->getData();
            $anneeConstruction = $formDevis->get('anneeconstruction')->getData();
            $superficie = $formDevis->get('superficie')->getData();
            $nom = $formDevis->get('nom')->getData();
            $tel = $formDevis->get('telephone')->getData();
            $mailContact = $formDevis->get('email')->getData();
            if ($formDevis->get('message')->getData()!=null){
                $message = $formDevis->get('message')->getData();
            }
            $ville = $formDevis->get('ville')->getData();
            $codePostal = $formDevis->get('codepostal')->getData();

            $email = (new Email())
                ->from($mailContact)
                ->to('gooddiagimmo@gmail.com')
                ->priority(Email::PRIORITY_HIGH)
                ->subject('Une nouvelle demande de devis pour GoodDiagImmo')
                ->text('vente ou location: ' . $venteOuLoc .','. "\n".
                    'type de bien: ' . $typeDeBien . ','."\n".
                    'année de construction: ' . $anneeConstruction .','. "\n".
                    'superficie: ' . $superficie . 'm2'.','."\n".
                    'de la part de Mr ou Mme ' . $nom . ','."\n".
                    'email: ' . $mailContact . ','."\n".
                    'telephone: ' . $tel . ','."\n".
                    'ville: ' . $ville .','. "\n".
                    'code postal: ' . $codePostal .','. "\n".
                    'message: ' . $message);
            $mailer->send($email);
            return $this->redirectToRoute('confirm');
        }

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->sendMail($form, $mailer);
            return $this->redirectToRoute('confirm2');
        }
        return $this->render('main/contactez-nous.html.twig', [
            'form' => $form->createView(),
            'formdevis' => $formDevis->createView(),
        ]);
    }

    /**
     * @Route("/actualite", name="actualite")
     */
    public function actualite(Request $request, MailerInterface $mailer, ArticleRepository $articleRepository): Response

    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->sendMail($form, $mailer);
            return $this->redirectToRoute('confirm2');
        }

        $articles = $articleRepository->findAll();
        return $this->render('main/actualite.html.twig', [
            'articles' => $articles,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/confirm", name="confirm")
     */
    public function confirm(Request $request, MailerInterface $mailer): Response
    {

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->sendMail($form, $mailer);
            return $this->redirectToRoute('confirm2');
        }

        return $this->render('main/confirm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/confirm2", name="confirm2")
     */
    public function confirm2(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->sendMail($form, $mailer);
            return $this->redirectToRoute('confirm2');
        }
        return $this->render('main/confirm2.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/mentionslegales", name="mentionslegales")
     */
    public function mentionslegales(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->sendMail($form, $mailer);
            return $this->redirectToRoute('confirm2');
        }
        return $this->render('main/mentionslegales.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("actualité/{slug}", name="articles_show")
     */
    public function articles($slug, Request $request, MailerInterface $mailer, ArticleRepository $articleRepository): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->sendMail($form, $mailer);
            return $this->redirectToRoute('confirm2');
        }
        $article = $articleRepository->findOneBy(['slug' => $slug]);
        return $this->render('main/article.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    public function sendMail($form, $mailer)
    {
        $nom = $form->get('nom')->getData();
        $tel = $form->get('telephone')->getData();
        $mailContact = $form->get('email')->getData();
        $message = $form->get('message')->getData();

        $email = (new Email())
            ->from($mailContact)
            ->to('gooddiagimmo@gmail.com')
            ->priority(Email::PRIORITY_HIGH)
            ->subject('Un nouveau contact GoodDiagImmo')
            ->text('Mr ou mme ' . $nom . ' a un message pour vous: ' . $message . ' contact: ' . $tel);
        $mailer->send($email);


    }
}
