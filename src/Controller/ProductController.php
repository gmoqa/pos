<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\Mapping\Entity;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController
 * @package App\Controller
 * @Route({
 *     "en":"/products",
 *     "es":"/productos"
 * })
 */
class ProductController extends BaseController
{
    /**
     * @var Entity
     */
    protected static $entityClass = Product::class;

    /**
     * @var array
     */
    protected static $searchFields = ['name', 'sku'];
    
    /**
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     * @Route("", name="product_index", methods="GET")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $q = $request->query->get('q');
        $query = $this->findAllByLike($q, self::$searchFields);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            7
        );
        
        return $this->render('product/index.html.twig',[ 'products' => $pagination]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/new", name="product_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Product $product
     * @return Response
     * @Route("/{id}", name="product_show", methods="GET")
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return Response
     * @Route("/{id}/edit", name="product_edit", methods="GET|POST")
     */
    public function edit(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_edit', ['id' => $product->getId()]);
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return Response
     * @Route("/{id}", name="product_delete", methods="DELETE")
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush();
        }

        return $this->redirectToRoute('product_index');
    }
}
