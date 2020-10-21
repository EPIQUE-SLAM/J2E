<?php

namespace App\Controller;
use App\Entity\Passager;
use App\Entity\Dossier;
use App\Entity\Voyage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MonController extends AbstractController
{
    /**
     * @return Response
     * @Route(path="/insertion")
     */
    public function insertion()
    {
//
//        $passager = new  Passager();
//        $passager->setId(1);
//        $passager->setPrenom("maxime");
//        $passager->setNom("danel");
//        $passager->setEmail("maximedanel@hotmail.fr");
//        $passager->setTelephone(+33626366084);
//        //$data = $passager;

//            $passager = new Passager();
//            $passager->setNom(_GET['user_nom']) ;
//            $passager->setPrenom(_GET['user_prenom']);
//            $passager->setEmail(_GET['user_email']);
//            $passager->setTelephone(_GET['user_telephone']);
//
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($passager);
//            $entityManager->flush();

        $dbname='bdd.sqlite';
        $mytable ="Contact";
        $mytable2 ="Voyageur";

        if(!class_exists('SQLite3'))
            die("SQLite 3 NOT supported.");

        $base=new SQLite3($dbname, 0666);

        $nom = "Danel";
        $prenom="Maxime";
        $methode = "email";
        $valeur="mailtest@gmail.com";


        $query = "INSERT INTO $mytable2(nom,prenom) 
                VALUES ('$nom', '$prenom')";
        $results = $base->exec($query);


           // $adresses = $entityManager->getRepository(Passager::class)->findAll();


        return $this->render('base.html.twig',['data'=>$results]);

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

//    /**
//     * @return Response
//     * @Route(path="/formAdresse")
//     */
//    public function formAdresse()
//    {
//
//        $entityManager = $this->getDoctrine()->getManager();
//        $adresses = $entityManager -> getRepository(Adresse::class)-> findAll();
//        return $this->render('formAdresse.html.twig');
//
//    }
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

