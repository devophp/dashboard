<?php

namespace Devophp\Bundle\EtcdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Devophp\Bundle\EtcdBundle\Entity\Cluster;

class AdminController extends Controller
{
    /**
     * @Route("/etcdadmin", name="_devophp_etcdadmin_index")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->container->get('doctrine')->getManager();
        $repo = $em->getRepository('DevophpEtcdBundle:Cluster');

        $clusters = $repo->findAll();


        return array('clusters' => $clusters);
    }

    /**
     * @Route("/etcdadmin/addcluster", name="_devophp_etcdadmin_addcluster")
     */
    public function addClusterAction()
    {
        $cluster = new Cluster();
        $cluster->setName('Darth\'s surprise birthday party');
        $cluster->setAddress('http://127.0.0.1:4001');
        $cluster->setDescription('Local dev etcd cluster');
        $em = $this->container->get('doctrine')->getManager();
        $em->persist($cluster);
        $em->flush();
        $clusterid =$cluster->getId();
        return $this->redirect($this->generateUrl('_devophp_etcdadmin_editcluster', array('clusterid'=> $clusterid)));

    }

    /**
     * @Route("/etcdadmin/editcluster/{clusterid}", name="_devophp_etcdadmin_editcluster")
     * @Template()
     */
    public function editClusterAction($clusterid)
    {
        $em = $this->container->get('doctrine')->getManager();
        $repo = $em->getRepository('DevophpEtcdBundle:Cluster');

        $cluster = $repo->findOneBy(array(
            'id' => $clusterid,
        ));

        return array('clusterid' => $clusterid, 'cluster' => $cluster);
    }

}
