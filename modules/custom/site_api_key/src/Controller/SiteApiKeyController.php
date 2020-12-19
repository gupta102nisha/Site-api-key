<?php
/**
 * @file
 * Contains \Drupal\site_api_key\Controller\SiteApiKeyController.
 */
namespace Drupal\site_api_key\Controller;

use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;


class SiteApiKeyController{
   
    public function content($site_api_key, NodeInterface $node){
        $site_api_key_default = \Drupal::config('siteapikey.configuration');
        $site_api_key_value = $site_api_key_default->get('siteapikey');
        if($node) {
            if($site_api_key_value == $site_api_key && $node->getType() == 'page' && $site_api_key_value != 'No API Key yet') {
                // echo '<pre>';print_r($node->getType());exit;
                return new JsonResponse($node->toArray());
            } 
        }
        
        // Respond for access denied
        return new JsonResponse(array("error" => "access denied"));
    }
}