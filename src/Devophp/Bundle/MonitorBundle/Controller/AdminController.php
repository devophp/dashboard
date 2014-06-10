<?php

namespace Devophp\Bundle\MonitorBundle\Controller;

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
     * @Route("/monitoradmin", name="_devophp_monitoradmin_index")
     * @Template()
     */
    public function indexAction()
    {
        $jsondata = file_get_contents('/tmp/devophp_monitor_status.json');
        $data = json_decode($jsondata, 1);
        $data['now'] = time();
        return $data;
    }

    /**
     * @Route("/monitoradmin/addcluster", name="_devophp_monitoradmin_addcluster")
     */
    public function addClusterAction()
    {
        /*
        $cluster = new Cluster();
        $cluster->setName('Darth\'s surprise birthday party');
        $cluster->setAddress('http://127.0.0.1:4001');
        $cluster->setDescription('Local dev etcd cluster');
        $em = $this->container->get('doctrine')->getManager();
        $em->persist($cluster);
        $em->flush();
        $clusterid =$cluster->getId();
        return $this->redirect($this->generateUrl('_devophp_etcdadmin_editcluster', array('clusterid'=> $clusterid)));
        */

    }

    /**
     * @Route("/monitoradmin/viewagent/{agenthostname}", name="_devophp_monitordadmin_viewagent")
     * @Template()
     */
    public function viewAgentAction($clusterid)
    {
        /*
        $em = $this->container->get('doctrine')->getManager();
        $repo = $em->getRepository('DevophpEtcdBundle:Cluster');

        $cluster = $repo->findOneBy(array(
            'id' => $clusterid,
        ));

        return array('clusterid' => $clusterid, 'cluster' => $cluster);
        */
        return "cool";
    }
}
