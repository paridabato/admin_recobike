<?php

namespace App\Controller;

use App\Entity\Kits;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\KitsType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Security("is_granted('ROLE_kits') or is_granted('ROLE_superadmin')")
 */
class KitsController extends AbstractController
{
    /**
     * @Route("/kit", name="kits")
     */
    public function kits(): Response
    {
        $repositoryKits = $this->getDoctrine()->getRepository('App:Kits');
        $kitsAll = $repositoryKits->findAll();

        return $this->render('app/kits.html.twig', [
            'kits' => $kitsAll,
        ]);
    }

    /**
     * @Route("/kit/creer", name="creerkits")
     */
    public function creerkits(Request $request): Response
    {
        $creerkits = $this->createForm(KitsType::class);
        $creerkits->handleRequest($request);
        if($creerkits->isSubmitted()) {
            if ($creerkits->isValid()) {
                $creerkitsFile = $creerkits->get('creerkits')->getData();
                if($creerkitsFile->getClientMimeType() != 'application/octet-stream'){
                    $request->getSession()->getFlashBag()->add('danger', 'Veuillez télécharger un document Excel valide.');
                }
                else{
                    $em = $this->getDoctrine()->getManager();
                    $repositoryMagasins = $this->getDoctrine()->getRepository('App:Magasins');
                    $spreadsheet = IOFactory::load($creerkitsFile);
                    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                    array_shift($sheetData);

                    if(false){
                        $conn = $em->getConnection();
                        $sql = 'DELETE FROM `kits`';
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                    }

                    foreach ($sheetData as $row){
                        $kits = new Kits();
                        $kits->setNumDepart((string)$row['A']);
                        $kits->setNumFin((string)$row['B']);
                        if(!is_null($row['C']))
                            $kits->setIdGrossiste($row['C']);
                        if(!is_null($row['D']))
                            $kits->setIdFabriquant($row['D']);
                        if(!is_null($row['E'])){
                            $is_magasins = $repositoryMagasins->find($row['E']);
                            if(!is_null($is_magasins))
                                $kits->setIdMagasin($is_magasins);
                        }
                        $kits->setNumClient($row['F']);
                        $em->persist($kits);
                        $em->flush();
                    }
                    $request->getSession()->getFlashBag()->add('success', 'Données du fichier importées!');
                }
            }
        }

        return $this->render('app/creerkits.html.twig', [
            'form' => $creerkits->createView(),
        ]);
    }
}
