<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class LoanController extends Controller
{
    /**
     * @Route("/add/product", name="add_product")
     */
    public function addProduct(ObjectManager $manager, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Vous devez être connecté pour accéder à cette page');
        
        $product = new Product();
        
        $form = $this->createForm(ProductType::class, $product)
                     ->add('Envoyer', SubmitType::class);
        
        // ATTENTION, la ligne suivante est obligatoire pour que le formulaire soit considéré comme Submitted
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            
            // upload du fichier image
            $image = $product->getImage();
            $fileName = md5(uniqid()).'.'.$image->guessExtension(); // guessExtension pour déduire quel produit on lui envoit et ainsi éviter qu'on nous envoit du PHP
           // procédural: move_uploaded_file
            $image->move('uploads/product', $fileName);
            $product->setImage($fileName);
            $product->setUser($this->getUser());
            
            // Enregistre produit dans BDD
            $manager->persist($product);
            $manager->flush();
            
            
        }
        
        return $this->render('add_product.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/product", name="my_product")
     */
    public function myProducts() {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Vous devez être connecté pour accéder à cette page');
        
        return $this->render('my_products.html.twig');
    }

}
