<?php
class XmlSitemapController extends Controller
{
	public function actionIndex()
	{
  //List of static pages
		$mainUrl = array(
			'',
			'contacts',
			'staff',
			'faq',
			'about-us',
		);
		
		$postUrl = Post::model()->findAll(array(
			'select'=>'urlFriendlyName',
		));
		
		//below array $url converted into required(sitemap.xml) structure		
		$xmldata = '<?xml version="1.0" encoding="utf-8"?>'; 
		$xmldata .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		foreach ($mainUrl as $url)
		{
			$link = Yii::app()->createAbsoluteUrl($url);
			
			$xmldata .= '<url>';
			$xmldata .= '<loc>'.$link.'</loc>';
			$xmldata .= '<lastmod>'.date('Y-m-d').'T'.date('H:i').'+00:00</lastmod>';//ex $data['lastmod']
			$xmldata .= '<changefreq>daily</changefreq>';
			$xmldata .= '<priority>0.5</priority>';
			$xmldata .= '</url>';
		}
		foreach ($postUrl as $url)
		{
			$link = Yii::app()->createAbsoluteUrl($url->urlFriendlyName);
			
			$xmldata .= '<url>';
			$xmldata .= '<loc>'.$link.'</loc>';
			$xmldata .= '<lastmod>'.date('Y-m-d').'T'.date('H:i').'+00:00</lastmod>';//ex $data['lastmod']
			$xmldata .= '<changefreq>daily</changefreq>';
			$xmldata .= '<priority>0.5</priority>';
			$xmldata .= '</url>';
		}	
		$xmldata .= '</urlset>'; 
		
		if(file_put_contents('sitemap.xml',$xmldata))
		{
			$this->render('index');
		}
	
	}
}
