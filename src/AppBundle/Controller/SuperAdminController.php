<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Club;
use AppBundle\Util\Constants;
use AppBundle\Util\MyControler;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class SuperAdminController
 * @package AppBundle\Controller
 * @Route("/club/superadmin")
 */
class SuperAdminController extends MyControler
{

    /**
     * @param Request $request
     * @Route("/clubs", name="superAdminShowClubs")
     * @return Response
     */
    public function showClubs(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository("AppBundle:Club");
        $clubs = $repo->findAll();

        return $this->render("club/superadmin/show_clubs.html.twig", ["clubs" => $clubs]);
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/addClub", name="superAdminAddClub")
     */
    public function indexAction(Request $request)
    {

        $clubForm = new ClubForm();
        $form = $this->createFormBuilder($clubForm)
            ->add("name", TextType::class)
            ->add("fullName", TextareaType::class)
            ->add("Spremi", SubmitType::class, ["label" => "Spremi"])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clubForm = $form->getData();

            $club = new Club();
            $club->setFullName($clubForm->getFullName());
            $club->setName($clubForm->getName());
            $m = $this->getDoctrine()->getManager();
            $m->persist($club);
            $m->flush();

            $this->addFlash(
                Constants::FLASH_SUCCESS,
                "Uspješno dodan klub! <br> Ime: "
                . $club->getName()
                . "<br> Opis: " . $club->getFullName()
            );
            return $this->redirectToRoute("superAdminAddClubSuccessful");

        }
        return $this->render('club/superadmin/add_club.html.twig', ["form" => $form->createView()]);
    }

    /**
     * @Route("/dodanKlubUspjesno", name="superAdminAddClubSuccessful" )
     *
     */
    public function showMessage()
    {
        return $this->render("util/flash_messages.html.twig");
    }

}

class ClubForm
{

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=50)
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=500)
     */
    private $fullName;

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}
