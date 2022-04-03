<?php

use Illuminate\Database\Seeder;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
    	DB::table('codes')->truncate();

        /**
         * Login to Twitter
         * Go to settings widget
         * Genetate code for page
         *  height 340
         *  checked  Auto-expand photos
         */
        DB::table('codes')->insert([
            'name' => 'ClientTwitter',
            'value' => '<a class="twitter-timeline" href="https://twitter.com/McDo_PH" data-widget-id="614031585629769729">Tweets by @McDo_PH</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>',
        ]);


        DB::table('codes')->insert([
            'name' => 'Competitor1Twitter',
            'value' => '<a class="twitter-timeline" href="https://twitter.com/Jollibee" data-widget-id="614033063249510400">Tweets by @Jollibee</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>',
        ]);

        DB::table('codes')->insert([
            'name' => 'Competitor2Twitter',
            'value' => '<a class="twitter-timeline" href="https://twitter.com/KFCPhilippines" data-widget-id="613961848564486144">Tweets by @KFCPhilippines</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>',
        ]);

        /**
         * to get facebook code got to
         * https://developers.facebook.com/docs/plugins/page-plugin
         */
        DB::table('codes')->insert([
            'name' => 'ClientFacebook',
            'value' => '
            <script type="text/javascript">
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=1620487431509244";
                fjs.parentNode.insertBefore(js, fjs);
              }(document, \'script\', \'facebook-jssdk\'));
            </script>

            <div id="fb-root"></div>
            <div 
              class="fb-page" 
              data-href="https://www.facebook.com/McDo.ph" 
              data-height="329" 
              data-small-header="true" 
              data-adapt-container-width="true" 
              data-hide-cover="true" 
              data-show-facepile="false" 
              data-show-posts="true"
            >
              <div class="fb-xfbml-parse-ignore">
                <blockquote cite="https://www.facebook.com/McDo.ph">
                  <a href="https://www.facebook.com/McDo.ph">
                    McDonald\'s
                  </a>
                </blockquote>
              </div>
            </div>
        ',]);

        DB::table('codes')->insert([
            'name' => 'Competitor1Facebook',
            'value' => '
            <script type="text/javascript">
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=1620487431509244";
                fjs.parentNode.insertBefore(js, fjs);
              }(document, \'script\', \'facebook-jssdk\'));
            </script>

            <div id="fb-root"></div>
            <div 
              class="fb-page" 
              data-href="https://www.facebook.com/JollibeePhilippines" 
              data-height="329"
              data-small-header="true" 
              data-adapt-container-width="true" 
              data-hide-cover="true" 
              data-show-facepile="false" 
              data-show-posts="true"
            >
              <div class="fb-xfbml-parse-ignore">
                <blockquote cite="https://www.facebook.com/JollibeePhilippines">
                  <a href="https://www.facebook.com/JollibeePhilippines">
                    Jollibee
                  </a>
                </blockquote>
              </div>
            </div>
        ',]);

        DB::table('codes')->insert([
            'name' => 'Competitor2Facebook',
            'value' => '
              <div id="fb-root"></div>
              <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=1620487431509244";
                fjs.parentNode.insertBefore(js, fjs);
              }(document, \'script\', \'facebook-jssdk\'));</script>

              <div class="fb-page" data-href="https://www.facebook.com/kfcphilippines" data-height="329" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/kfcphilippines"><a href="https://www.facebook.com/kfcphilippines">KFC</a></blockquote></div></div>
            ']);

        /**
         * get instagram id from
         * http://jelled.com/instagram/lookup-user-id#
         */
        DB::table('codes')->insert([
            'name' => 'ClientInstagram',
            'value' => '460339170',
        ]);


    }
}
