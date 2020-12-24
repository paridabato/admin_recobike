<?php


namespace App\Controller;

use App\Form\MarquagesViewType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormBuilder;
use App\Entity\Marquages;
use App\Form\MarquagesType;
use Symfony\Component\HttpFoundation\Response;


class MarquagesController extends AbstractController
{
    /**
     * @Route("/marquage", name="marquages")
     */
    public function marquages(){
        $repositoryMarquages = $this->getDoctrine()->getRepository('App:Marquages');
        $marquagesAll = $repositoryMarquages->findAll();

        return $this->render('app/marquages.html.twig', [
            'marquages' => $marquagesAll,
        ]);
    }

    /**
     * @Route("/marquage/creer", name="creermarquages")
     */
    public function creerMarquages(Request $request): Response
    {
        $creermarquages = $this->createForm(MarquagesType::class);
        $creermarquages->handleRequest($request);
        if($creermarquages->isSubmitted()) {
            if ($creermarquages->isValid()) {
                $creermarquagesFile = $creermarquages->get('creermarquages')->getData();
                if($creermarquagesFile->getClientMimeType() != 'application/octet-stream'){
                    $request->getSession()->getFlashBag()->add('danger', 'Veuillez télécharger un document Excel valide.');
                }
                else{
                    $em = $this->getDoctrine()->getManager();
                    $repositoryMagasins = $this->getDoctrine()->getRepository('App:Magasins');
                    $repositorydGrossistes = $this->getDoctrine()->getRepository('App:Grossistes');
                    $repositorydFabriquants = $this->getDoctrine()->getRepository('App:Fabriquants');

                    $spreadsheet = IOFactory::load($creermarquagesFile);
                    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                    array_shift($sheetData);

                    if(false){
                        $conn = $em->getConnection();
                        $sql = 'DELETE FROM `marquages`';
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                    }

                    foreach ($sheetData as $row){
                        $marquages = new Marquages();
                        $marquages->setSource((string)$row['A']);
                        $marquages->setNumero((string)$row['B']);
                        if(!is_null($row['C'])){
                            $is_grossistes = $repositorydGrossistes->find($row['E']);
                            if(!is_null($is_grossistes))
                                $marquages->setIdGrossiste($is_grossistes);
                        }
                        if(!is_null($row['D']))
                            $is_fabriquants = $repositorydFabriquants->find($row['E']);
                            if(!is_null($is_fabriquants))
                                $marquages->setIdFabriquant($is_fabriquants);
                        if(!is_null($row['E'])){
                            $is_magasins = $repositoryMagasins->find($row['E']);
                            if(!is_null($is_magasins))
                                $marquages->setIdMagasin($is_magasins);
                        }
                        $marquages->setTypeEngin($row['F']);
                        $marquages->setMarque($row['G']);
                        $marquages->setModele($row['H']);
                        $marquages->setCouleur($row['I']);
                        $marquages->setNumSerieVelo($row['J']);
                        $em->persist($marquages);
                        $em->flush();
                    }
                    $request->getSession()->getFlashBag()->add('success', 'Données du fichier importées!');
                }
            }
        }

        return $this->render('app/creermarquages.html.twig', [
            'form' => $creermarquages->createView(),
        ]);
    }

    /**
     * @Route("/marquage/view/{id}", name="views_marquages_id")
     */
    public function viewsMarquages($id){
        $repositoryMarquages = $this->getDoctrine()->getRepository('App:Marquages');
        $marquages = $repositoryMarquages->find($id);

        $creermarquages = $this->createForm(MarquagesViewType::class, $marquages);

        return $this->render('app/viewmarquages.html.twig', [
            'form' => $creermarquages->createView(),
        ]);
    }
}