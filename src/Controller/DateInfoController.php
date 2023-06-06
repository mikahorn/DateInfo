<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\DateInfoFormType;
use App\Form\FormProcessing;
use App\API\Feiertage;
use App\API\LPLib_Feiertage_Connector;
use Symfony\Component\HttpFoundation\Request;


class DateInfoController extends AbstractController
{
    #[Route('/DateInfo', name: 'app_date_info')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(DateInfoFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData(); 
            $input = $data->yourDate; 

            $processing = new FormProcessing();

            $timeDifference = $processing->getDifference($input);
            $weekday = $processing->getWeekday($input);
            $timeTokyo = $processing->getTimezoneTokyo($input);
            $timeNewYork = $processing->getTimezoneNewYork($input);
            $feiertag = $processing->getFeiertag($input);

            $tag = $input->format('j');
            $monat = $processing->getMonat($input);
            $jahr = $input->format('Y');
            $minuten = $input->format('H:i:s');
        
            return $this->render('date_info/results.html.twig',[
                'weekday' => $weekday,
                'tokyotime' => $timeTokyo,
                'newyorktime' => $timeNewYork,
                'feiertag' => $feiertag,
                'timedifference' => $timeDifference,
                'yourdate' => $input,
                'tag' => $tag,
                'monat' => $monat,
                'jahr' => $jahr,
                'minuten' => $minuten
            ]);         
        }
        return $this->render('date_info/index.html.twig',[
            'formvar' => $form
        ]);
    }
}
