<?php

namespace App\Controller;
use App\Entity\Contact;
use App\Entity\Passager;
use App\Entity\Dossier;
use App\Entity\Voyage;
use App\Entity\Voyageur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MonController extends AbstractController
{

    /**
     * @return Response
     * @Route(path="/formPassager")
     */
    public function formPassager()
    {

        $entityManager = $this->getDoctrine()->getManager();
        //$adresses = $entityManager -> getRepository(Adresse::class)-> findAll();
        return $this->render('formPassager.html.twig');

    }


    /**
     * @return Response
     * @Route(path="/insertion")
     */
    public function insertion()
    {

//        $passager = new  Passager();
//        $passager->setId(1);
//        $passager->setPrenom("maxime");
//        $passager->setNom("danel");
//        $passager->setEmail("maximedanel@hotmail.fr");
//        $passager->setTelephone(+33626366084);
        //$data = $passager;

            $voyageur = new Voyageur();
            $voyageur->setNom($_GET['user_nom']) ;
            $voyageur->setPrenom($_GET['user_prenom']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voyageur);
            $entityManager->flush();

            $contact = new Contact();
           if (($_GET['user_mail']!=null) && ($_GET['user_telephone']!=null)) {

            $contact->setMethode('mail');
            $contact->setValeur($_GET['user_mail']);
            $contact -> setIdVoyageur($voyageur -> getIdVoyageur()) ;

            $contact2 = new Contact();
            $contact2->setMethode('telephone');
            $contact2->setValeur($_GET['user_telephone']);
            $contact2 -> setIdVoyageur($voyageur -> getIdVoyageur()) ;
               $entityManager = $this->getDoctrine()->getManager();
               $entityManager->persist($contact2);
               $entityManager->flush();
           }

            else if (($_GET['user_telephone']!=null) ) {
                $contact->setMethode('telephone');
                $contact->setValeur($_GET['user_telephone']);
                $contact -> setIdVoyageur($voyageur -> getIdVoyageur()) ;
            }

            else if (($_GET['user_mail']!=null) ) {
                $contact->setMethode('mail');
                $contact->setValeur($_GET['user_mail']);
                $contact -> setIdVoyageur($voyageur -> getIdVoyageur()) ;
            }




            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();


            $passagers = $entityManager->getRepository(Passager::class)->findAll();


        return $this->render('base.html.twig',['data'=>$passagers]);

    }




    /**
     * @return Response
     * @Route(path="/affichagePassagers")
     */
    public function affichagePassagers(){

        $entityManager = $this->getDoctrine()->getManager();
        $passagers = $entityManager->getRepository(Passager::class)->findAll();
        return $this->render('base.html.twig', ['data' => $passagers]);


    }

    /**
     * @return Response
     * @Route(path="/affichageInfoVoyage")
     */
    public function affichageInfoVoyage(){

        $id_passager = 1;
        $entityManager = $this->getDoctrine()->getManager();
        $passagers = $entityManager->getRepository(Passager::class)->findById($id_passager);
        $dossiers = $entityManager->getRepository(Dossier::class)->findByIdPassager($id_passager);

        return $this->render('infoVoyage.html.twig', ['pass' => $passagers, 'dossier'=>$dossiers]);


    }

    /**
     * @return Response
     * @Route(path="/affichagePassagersTransport")
     */
    public function affichagePassagersTransport(){

        $id_voyage = 1;
        $entityManager = $this->getDoctrine()->getManager();
        $dossierVoyage = $entityManager->getRepository(Dossier::class)->findByVoyage($id_voyage);
        $voyage = $entityManager->getRepository(Voyage::class)->findByIdVoyage($id_voyage);

        $id_passager = $entityManager->getRepository(Dossier::class)->findByVoyage($id_voyage);
        $passager = $entityManager->getRepository(Passager::class)->findById($id_passager);

        return $this->render('passagersTransport.html.twig', ['dossierVoyage'=>$dossierVoyage, 'voyage'=>$voyage, 'pass'=> $passager]);


    }


    /**
     * @return Response
     * @Route(path="/affichagePassagersPourUnPassager")
     */

    public function affichagePassagersPourUnPassager(){

        $id_passager = 3;
        $entityManager = $this->getDoctrine()->getManager();
        $voyageOfPassager = $entityManager->getRepository(Dossier::class)->findByIdPassager($id_passager);
        $id_Allpassagers = $entityManager->getRepository(Dossier::class)->findByVoyage($voyageOfPassager);
        $allpassagers = $entityManager->getRepository(Passager::class)->findById($id_Allpassagers);

        return $this->render('passagersPourUnPassager.html.twig', [ 'passagers'=> $allpassagers]);

    }

//
//
//    /**
//     * @return Response
//     * @Route(path="/ajout")
//     */
//    public function ajout()
//    {
//
//        //if ( isset( $_GET['submit'] ) ) {
//
//            $adresse = new Adresse();
//            $adresse->numero = $_GET['user_numero'];
//            $adresse->rue = $_GET['user_voie'];
//            $adresse->ville = $_GET['user_ville'];
//            $adresse->pays = $_GET['user_pays'];
//
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($adresse);
//            $entityManager->flush();
//
//            $etudiant = new Etudiant();
//            $etudiant->prenom = $_GET['user_prenom'];
//            $etudiant -> setNom($_GET['user_name']) ;
//            $etudiant->age = $_GET['user_naissance'];
//            $entityManager = $this->getDoctrine()->getManager();
//            $etudiant->adresse = $adresse;
//            $entityManager->persist($etudiant);
//            $entityManager->flush();
//
//            $adresses = $entityManager->getRepository(Adresse::class)->findAll();
//            $etudiants = $entityManager->getRepository(Etudiant::class)->findAll();
//
//        //}
//
//        return $this->render('base.html.twig', ['adr' => $adresses, 'etu' => $etudiants]);
//
//
//    }
//
//
//
//    /**
//     * @return Response
//     * @Route(path="/suppression")
//     */
//    public function suppression()
//    {
//
//        $entityManager = $this->getDoctrine()->getManager();
//        $etudiant = $entityManager -> getRepository(Etudiant::class)-> find(13);
//        $entityManager -> remove($etudiant);
//        $entityManager -> flush();
//
//        $etudiant = $entityManager -> getRepository(Etudiant::class)-> findAll();
//        return $this->render('base.html.twig',['etu'=>$etudiant]);
//
//    }
//
//    /**
//     * @return Response
//     * @Route(path="/update")
//     */
//    public function update()
//    {
//
//        $entityManager = $this->getDoctrine()->getManager();
//        //$etudiant = new Etudiant();
//        $etudiant = $entityManager -> getRepository(Etudiant::class)-> find(12);
//        $etudiant->age=62;
//        $entityManager -> persist($etudiant);
//        $entityManager -> flush();
//
//        $etudiant = $entityManager -> getRepository(Etudiant::class)-> findAll();
//        return $this->render('base.html.twig',['etu'=>$etudiant]);
//
//    }

}

