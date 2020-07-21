<?php
namespace App\Http\Controllers\Curl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\simple_html_dom;

use App\Models\Post;
use App\Models\PostCategory;

class ChungController extends Controller
{
    public function __construct()
    {
        session_start();
    }

    private function curl($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_REFERER, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $str = curl_exec($curl);
        curl_close($curl);

        $html = new simple_html_dom();
        $html->load($str);
        return $html;
    }

    public function index($url = 'https://chungnguyen.xyz/category/laravel')
    {
        ini_set('max_execution_time', '-1');
        $html = $this->curl($url);
         for($i = 10 ; $i >= 1; $i--){
             $link = $url.'?page='.$i;
            $html = $this->curl($link);
            foreach($html->find('.post-title a') as $value){
                $count = Post::where('link',$value->href)->count();
                if($count == 0){
                    $product_id = Post::create([
                        'link'              => $value->href,
                        'title'             => $value->plaintext,
                        'slug'              => str_slug($value->plaintext),
                        'seo_title'         => $value->plaintext,
                        'seo_keywords'      => str_slug($value->plaintext),
                    ])->id;
                    if($product_id){
                        $this->getPost($value->href,$product_id);
                        PostCategory::create([
                            'post_id'       => $product_id,
                            'category_id'   => 21
                        ]);
                    }
                }
            }
        }
    }

    public function getPost($url,$id)
    {
        $html = $this->curl($url);
        $description = $html->find('.post-content .text-left p',0);
        $description = ($description) ? $description->plaintext : '';
        $content = $html->find('.post-content .text-left',0)->innertext;
        $update = Post::where('id',$id)->update([
            'content'           => '<div class="text-left">'.$content.'</div>',
            'description'       => $description,
            'seo_description'   => $description,
            'thumbnail'         => 'uploads/image-post.jpg',
        ]);
    }

    public function posts()
    {
        $posts = Post::get();
        foreach($posts as $post){
            $url = $post->link;
            $html = $this->curl($url);
            $description = $html->find('.post-content .text-left p',0);
            $description = ($description) ? $description->innertext : '';
            $content = $html->find('.post-content',0)->innertext;
            $update = Post::where('id',$post->id)->update([
                'content'           => $content,
                'description'       => $description,
                'seo_title'         => $post->title,
                'seo_description'   => $description,
                'seo_keywords'      => $post->slug,
                'thumbnail'         => 'uploads/image-post.jpg',
            ]);
            
        }
    }
}