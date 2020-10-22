<?php

namespace App\Controller;
use App\Entity\Contact;
use App\Entity\Dossiers;
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
     * @Route(path="/main")
     */
    public function main()
    {

        $entityManager = $this->getDoctrine()->getManager();
        return $this->render('main.html.twig');

    }

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
     * @Route(path="/formDossier")
     */
    public function formDossier()
    {
        $entityManager = $this->getDoctrine()->getManager();
        //$adresses = $entityManager -> getRepository(Adresse::class)-> findAll();
        $allVoyages = $entityManager->getRepository(Voyage::class)->findAll();
        $allPassagers = $entityManager->getRepository(Passager::class)->findAll();

        return $this->render('formDossier.html.twig',[ 'voyage'=>$allVoyages, 'pass'=>$allPassagers]);
    }

    /**
     * @return Response
     * @Route(path="/newDossier")
     */
    public function newDossier()
    {

        $dossier = new Dossiers();
        $dossier->setIdVoyageur($_GET['listeP']) ;
        $dossier -> setIdVoyage($_GET['listeV']);

        $entityManager = $this->getDoctrine()->getManager();

        $voyage = $entityManager->getRepository(Voyage::class)->findOneById_Voyage($_GET['listeV']);

        print_r($voyage);
        $methode = $voyage -> getType();
        $date = $voyage -> getDate();
        $depart = $voyage -> getLieuDepart();
        $arrivee = $voyage -> getLieuArrivee();


        $dossier -> setMethode($methode);
        $dossier -> setDate($date);
        $dossier -> setDepart($depart);
        $dossier -> setArrivee($arrivee);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($dossier);
        $entityManager->flush();
        return $this->render('main.html.twig');
        //$contact = new Contact();
   /*     if (($_GET['user_mail']!=null) && ($_GET['user_telephone']!=null)) {

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
*/

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
     * @Route(path="/affichageVoyages")
     */
    public function affichageVoyages(){

        $entityManager = $this->getDoctrine()->getManager();
        $voyages = $entityManager->getRepository(Voyage::class)->findAll();
        return $this->render('voyages.html.twig', ['data' => $voyages]);


    }

    /**
     * @return Response
     * @Route(path="/affichageInfoVoyage")
     */
    public function affichageInfoVoyage(){

        $id_passager = $_GET['listeP'];
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

        $id_voyage = $_GET['listeV'];
        $entityManager = $this->getDoctrine()->getManager();
        $dossierVoyage = $entityManager->getRepository(Dossier::class)->findByVoyage($id_voyage);
        $voyage = $entityManager->getRepository(Voyage::class)->findByIdVoyage($id_voyage);


        $idPassager = [];
        foreach ($dossierVoyage as $d) {
            $idPassager [] = $d->getIdPassager();
        }
        $passager= $entityManager->getRepository(Passager::class)->findById($idPassager);



        return $this->render('passagersTransport.html.twig', [  'voyage'=>$voyage, 'pass'=> $passager, 'doss' =>$dossierVoyage, 'numero' => $id_voyage]);


    }


    /**
     * @return Response
     * @Route(path="/affichagePassagersPourUnPassager")
     */

    public function affichagePassagersPourUnPassager(){

        $id_passager = $_GET['listeP'];
        $entityManager = $this->getDoctrine()->getManager();
        $voyageOfPassager = $entityManager->getRepository(Dossier::class)->findByIdPassager($id_passager);

        $idVoyage = [];
        foreach ($voyageOfPassager as $v) {
            $idVoyage [] = $v->getVoyage();
        }
        $id_Allpassagers = $entityManager->getRepository(Dossier::class)->findByVoyage($idVoyage);


        $idPassagers = [];
        foreach ($id_Allpassagers as $p) {
            $idPassagers [] = $p->getIdPassager();
        }

        $allpassagers = $entityManager->getRepository(Passager::class)->findById($idPassagers);

        return $this->render('passagersPourUnPassager.html.twig', [ 'passagers'=> $allpassagers, 'numPass' => $id_passager]);

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

