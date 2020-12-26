<?php


namespace App\Controller;

use App\Form\MarquagesViewType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormBuilder;
use App\Entity\Marquages;
use App\Entity\Statuts;
use App\Form\MarquagesType;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("is_granted('ROLE_marquages') or is_granted('ROLE_superadmin')")
 */
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
                    $repositoryStatuts = $this->getDoctrine()->getRepository('App:Statuts');

                    $spreadsheet = IOFactory::load($creermarquagesFile);
                    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                    array_shift($sheetData);

                    if(false){
                        $conn = $em->getConnection();
                        $sql = 'DELETE FROM `marquages`';
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                    }

                    foreach ($sheetData as $k=>$row){
                        if(count(array_diff($row, array('', NULL, false)))!= 8){
                            $request->getSession()->getFlashBag()->add('warning', 'La ligne n° '.($k+1).' du fichier n\'est pas importée - toutes les données de la ligne sont obligatoires');
                            continue;
                        }

                        $marquages = new Marquages();
                        $marquages->setSource((string)$row['A']);
                        $marquages->setNumero((string)$row['B']);
                        $marquages->setTypeEngin($row['C']);
                        $marquages->setMarque($row['D']);
                        $marquages->setModele($row['E']);
                        $marquages->setCouleur($row['F']);
                        if(!is_null($row['G'])){
                            $is_statuts = $repositoryStatuts->find($row['G']);
                            if(!is_null($is_statuts))
                                $marquages->setIdStatut($is_statuts);
                        }
                        $marquages->setNumSerieVelo($row['H']);
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