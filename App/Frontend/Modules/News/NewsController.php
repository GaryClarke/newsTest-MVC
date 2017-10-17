<?php
namespace App\Frontend\Modules\News;

use \OCFram\BackController;
use \OCFram\HTTPRequest;

class NewsController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $news_number = $this->app->config()->get('news_number');
        $characters_number = $this->app->config()->get('characters_number');

        // On ajoute une définition pour le titre.
        $this->page->addVar('title', 'Liste des '.$news_number.' dernières news');

        // On récupère le manager des news.
        $manager = $this->managers->getManagerOf('News');

        // Cette ligne, vous ne pouviez pas la deviner sachant qu'on n'a pas encore touché au modèle.
        // Contentez-vous donc d'écrire cette instruction, nous implémenterons la méthode ensuite.
        $newsList = $manager->getList(0, $news_number);

        foreach ($newsList as $news)
        {
            if (strlen($news->content()) > $characters_number)
            {
                $string = substr($news->content(), 0, $characters_number);
                $string = substr($string, 0, strrpos($string, ' ')) . '...';

                $news->setcontent($string);
            }
        }

        // On ajoute la variable $newsList à la vue.
        $this->page->addVar('newsList', $newsList);
    }
}