<?php

namespace App\Helpers;

class PhotosFake {
    protected static function getPeople() {
        $imageKitKey = env('IMAGEKIT_ID', 'ctyttbqpls');
        $pathUrl = 'https://ik.imagekit.io/'.$imageKitKey;

        return [
            $pathUrl.'/people/jamill-del-rosario-9BC1MDq8vvw-unsplash_oRw4bku3Jb.jpg',
            $pathUrl.'/people/dima-dallacqua-FBoST6UEZwE-unsplash_qVgQslJ6mS.jpg',
            $pathUrl.'/people/nathan-dumlao-TNp1suHTOi4-unsplash_u8evm5PnVy.jpg',
            $pathUrl.'/people/jose-martinez-Vt5inZuqFvg-unsplash_12KKEzxVa4.jpg',
            $pathUrl.'/people/jamill-del-rosario-jn3w2ouoPv4-unsplash_dVuA67BA3F.jpg',
            $pathUrl.'/people/manny-moreno-Ri_Al1VqjsU-unsplash_hj3hLTRR8b.jpg',
            $pathUrl.'/people/noemi-macavei-katocz-6ecsew5yOBE-unsplash_YM4wGaB63h.jpg',
            $pathUrl.'/people/benn-mcguinness-SrhDR2A3qG0-unsplash_SlltcHEmk3.jpg',
            $pathUrl.'/people/raamin-ka-Pu2SL9SawYY-unsplash_Z4NH_JHPuF.jpg',
            $pathUrl.'/people/ashley-byrd-7XaJPQ6IyGw-unsplash_urxG5dIKSN.jpg',
            $pathUrl.'/people/elia-pellegrini-dOCqU2QRKfw-unsplash_URWdul1GKN.jpg',
            $pathUrl.'/people/benigno-hoyuela-WeNhQostmiY-unsplash_lRmEiAIO1C.jpg',
            $pathUrl.'/people/ben-weber-osPsRNOZwIA-unsplash_ASDVf4OWs.jpg',
            $pathUrl.'/people/sergey-sokolov-cO-5xW3uDxo-unsplash_LMWTHn-0x.jpg',
            $pathUrl.'/people/tal-heres-7UuMFnZqt7M-unsplash_uOorhyNQRP.jpg',
            $pathUrl.'/people/kizkopop-uVEMRgYQxG0-unsplash_ThDq3s1K0k.jpg',
            $pathUrl.'/people/dimitry-zub-whpfCEHJEGE-unsplash_c1u9U7a1k.jpg',
            $pathUrl.'/people/dimitry-zub-lp-RkbrfsKA-unsplash_oCORJAnzuc.jpg',
            $pathUrl.'/people/kristen-higgins-QJRaL6K_XT0-unsplash_q6ABe_6uM.jpg',
            $pathUrl.'/people/ospan-ali-3nO6NsHH0Bo-unsplash_UYJhrkqJT.jpg',
            $pathUrl.'/people/hans-mendoza-1athw-6ENAY-unsplash_dnYnOne1X.jpg',
            $pathUrl.'/people/logan-weaver-IPrAWav-9qs-unsplash_kF4cJ5Uk1p.jpg',
            $pathUrl.'/people/adrian-balasoiu-uWsevuYayj8-unsplash_c4JWX6b7n.jpg',
            $pathUrl.'/people/tengyart-zon-KWw8TGg-unsplash_t61rnTwo4s.jpg',
            $pathUrl.'/people/abbat-3AGbDSYfALw-unsplash_toyhAkXYx.jpg',
            $pathUrl.'/people/erik-lucatero-d2MSDujJl2g-unsplash_K_h-nD_sz-.jpg',
            $pathUrl.'/people/sayan-ghosh-ZRVmiVKFMDs-unsplash_T2dufxPzgS.jpg',
            $pathUrl.'/people/gita-krishnamurti-5tc4P8sbuxU-unsplash_JxldumCXE.jpg',
            $pathUrl.'/people/igor-starkov-f4mLA8nDbRg-unsplash_Vj2cFk3f3P.jpg',
            $pathUrl.'/people/josh-pereira-v_G4znGSthU-unsplash_a0UizLvz01.jpg',
            $pathUrl.'/people/abbat-xLD6QNhI0jM-unsplash_4Ae7B02SqN.jpg',
            $pathUrl.'/people/tyler-nix-ZGa9d1a_4tA-unsplash_FvW9VBzbmQ.jpg',
            $pathUrl.'/people/elijah-hiett-umfpFoKxIVg-unsplash_zkLoRCGk5.jpg',
            $pathUrl.'/people/david-hinkle-kZbLcsYHJE0-unsplash_XrrwMUg2j.jpg',
            $pathUrl.'/people/michele-seghieri-eOC_7rRnSBg-unsplash_YqSHo-h8lX.jpg',
            $pathUrl.'/people/oscar-nord-1UJNl0Ffhw8-unsplash_D3YmpQkZtA.jpg',
            $pathUrl.'/people/sincerely-media-5LYQQS_JUgY-unsplash_dIajNfuhWj.jpg',
            $pathUrl.'/people/pedram-normohamadian-MrETbReEVjw-unsplash_ffzTRrMLIA.jpg',
            $pathUrl.'/people/connor-wilkins-eW6JCH_fbck-unsplash_CTzLIgepSC.jpg',
            $pathUrl.'/people/steven-aguilar-YW-O8n2nH90-unsplash_yZCt00j8Dp.jpg',
            $pathUrl.'/people/max-ducourneau-md_ESSsOhxM-unsplash_BGBIKVt2cG.jpg',
            $pathUrl.'/people/junior-reis-_dB16mJ60eA-unsplash_MJOVZfEK2.jpg',
            $pathUrl.'/people/huzeyfe-turan-lAbXOA6JXhE-unsplash_kacEnvG7la.jpg',
            $pathUrl.'/people/craig-chitima-9IZIP5KEt3E-unsplash_Zj--HFC6xX.jpg',
            $pathUrl.'/people/kevin-turcios-YQHIGN0I3j0-unsplash_o_h_9qZVL.jpg',
            $pathUrl.'/people/luke-dahlgren-pYpQzn3vZ9Q-unsplash_gBITx7WaG-.jpg',
            $pathUrl.'/people/nikola-jovanovic-gn9NaZ124yY-unsplash_-RW7rGgE4h.jpg',
            $pathUrl.'/people/aral-tasher-vBumGhXdgTE-unsplash_O2n9FoI0n.jpg',
            $pathUrl.'/people/carlos-augusto-Vs2dnKDZpkE-unsplash_CZCWkaqzr.jpg',
            $pathUrl.'/people/jennifer-marquez-5jMhekOP4DE-unsplash_gNNDKxIep.jpg',
            $pathUrl.'/people/angelo-pantazis-CJS6MKAIN6Q-unsplash_Np5I5lG9XD.jpg',
            $pathUrl.'/people/benjamin-klaver-tO9IuN7_hEE-unsplash__sB5vShvYL.jpg',
            $pathUrl.'/people/jennifer-marquez-CF1zlxovVHM-unsplash_zxDm-8bpf.jpg',
            $pathUrl.'/people/marcos-paulo-prado-qsG_fPHIWgw-unsplash_N9ezlr2eiV.jpg',
            $pathUrl.'/people/ihssan-rami-azouagh-SSHXyog6lms-unsplash_EW5trTpvr.jpg',
            $pathUrl.'/people/spencer-davis-prMA-_Zy4xg-unsplash_VeBQuQtjf.jpg',
            $pathUrl.'/people/gbarkz-vqKnuG8GaQc-unsplash_SlNZyLxfT.jpg',
            $pathUrl.'/people/dainis-graveris-FekpRww0rmo-unsplash_oUb8OPBXmj.jpg',
        ];
    }

    protected static function getAdminPeople() {
        $imageKitKey = env('IMAGEKIT_ID', 'ctyttbqpls');
        $pathUrl = 'https://ik.imagekit.io/'.$imageKitKey;

        return [
            $pathUrl.'/admin_people/linkedin-sales-navigator-pAtA8xe_iVM-unsplash_Euq_rp5se.jpg',
            $pathUrl.'/admin_people/gregory-hayes-h5cd51KXmRQ-unsplash_tgZcwQaN4k.jpg',
            $pathUrl.'/admin_people/itay-verchik-wK8zm2vkKXA-unsplash_xXr9SXof3f.jpg',
            $pathUrl.'/admin_people/christina-wocintechchat-com-0Zx1bDv5BNY-unsplash_nYBLwIlAIo.jpg',
            $pathUrl.'/admin_people/amy-hirschi-b3AYk8HKCl0-unsplash_Pm2lY9i3Z.jpg',
            $pathUrl.'/admin_people/hannah-nicollet-JQ2D4I-2eyw-unsplash_bWI35Unrt.jpg',
            $pathUrl.'/admin_people/jeremy-mcgilvrey-Mum-4dB0VsE-unsplash_2BhgvoMdsm.jpg',
            $pathUrl.'/admin_people/bantersnaps-pzOUnvx9c1E-unsplash_vFZZwpVuGD.jpg',
        ];
    }

    protected static function getPosts() {
        $imageKitKey = env('IMAGEKIT_ID', 'ctyttbqpls');
        $pathUrl = 'https://ik.imagekit.io/'.$imageKitKey;

        return [
            $pathUrl.'/posts/max-titov-xtRWIviknsw-unsplash_V3eNrVFr7A.jpg',
            $pathUrl.'/posts/milo-weiler-1AIYdIb3O5M-unsplash_ieLb6BhgaD.jpg',
            $pathUrl.'/posts/jon-tyson-WaOwBKTiQcg-unsplash__qI-gGoQXv.jpg',
            $pathUrl.'/posts/nathan-dumlao-Zmtg_XJWqAs-unsplash_AgZMv0H-tf.jpg',
            $pathUrl.'/posts/eric-kane-X-MbINOd9kY-unsplash_edcvxfLMHi.jpg',
            $pathUrl.'/posts/rene-ranisch-bYlqNjbiROs-unsplash_cJr2sjK8db.jpg',
            $pathUrl.'/posts/jeremy-mcgilvrey-ff9WzJsrEe0-unsplash_cSiw1QvpfM.jpg',
            $pathUrl.'/posts/mika-baumeister-J5yoGZLdpSI-unsplash_Xa4Pv18woE.jpg',
            $pathUrl.'/posts/nikolay-tarashchenko-ep6Afz45gH0-unsplash_wzbpk7-K4p.jpg',
            $pathUrl.'/posts/jessica-lewis-OuyrL0dyM9s-unsplash_CgqkPbi7pi.jpg',
            $pathUrl.'/posts/james-lee-qI8oiEttsOY-unsplash_u1HS_N4fF2.jpg',
            $pathUrl.'/posts/mati-flo-hMv_eRKuaL4-unsplash_piHjEEoSg.jpg',
            $pathUrl.'/posts/kristina-tripkovic-fvC5KxA5mPw-unsplash_YJ3yEwhP7P.jpg',
            $pathUrl.'/posts/graham-mansfield-y7ywDXWJ-JU-unsplash_ONWVqX_07c.jpg',
            $pathUrl.'/posts/guille-pozzi-2xkAA5Ez_oU-unsplash_Jyj13wH0To.jpg',
            $pathUrl.'/posts/mousum-de-onpxyxjwKm0-unsplash_wtm3Eq0SQ-.jpg',
            $pathUrl.'/posts/marek-piwnicki-mt9TrXpGQjo-unsplash_XVnQfAzH8o.jpg',
            $pathUrl.'/posts/halgatewood-com-OgvqXGL7XO4-unsplash_nEVGsMvkxt.jpg',
            $pathUrl.'/posts/olga-kysliuk-PJBtrRJ6u0Y-unsplash_iffVpJNvEN.jpg',
            $pathUrl.'/posts/joshua-hanson-wFW4zlulBT8-unsplash_xBjUvw3Hlc.jpg',
            $pathUrl.'/posts/nubelson-fernandes-iqxAMCdfKz0-unsplash_8jah5y1ZnK.jpg',
            $pathUrl.'/posts/marek-piwnicki-0WMRphCk0Bk-unsplash_gE8Tah7gWL.jpg',
            $pathUrl.'/posts/mark-basarab-0bRbCkmbVnU-unsplash_cF4SKV3z-1.jpg',
            $pathUrl.'/posts/moises-gonzalez-UxLax47oRSc-unsplash_6RZHoFuylw.jpg',
            $pathUrl.'/posts/vince-fleming-lIat5Z-N3JA-unsplash_rYFrkBnJv1.jpg',
            $pathUrl.'/posts/vika-aleksandrova-tJ6dWYTzlwU-unsplash_56DVjzcM9J.jpg',
            $pathUrl.'/posts/diana-macesanu-3ciHxbx9H0U-unsplash_dF_NFS5Gi.jpg',
            $pathUrl.'/posts/thought-catalog-ZMVtx_KJtOk-unsplash_xWXy-YR-m-.jpg',
            $pathUrl.'/posts/matthew-hume-I9zW-9Qz7tU-unsplash_tTFGh8tt0J.jpg',
            $pathUrl.'/posts/zac-durant-_6HzPU9Hyfg-unsplash_i7K9cP6Nyl.jpg',
            $pathUrl.'/posts/miguel-oros-ddDBDttXZwE-unsplash_iy0_vz3z2_.jpg',
            $pathUrl.'/posts/jeremy-bishop-_CFv3bntQlQ-unsplash_83jet3y-qj.jpg',
            $pathUrl.'/posts/guillaume-marques-L2Wri9t7rQI-unsplash_bOXKHxKTSA.jpg',
            $pathUrl.'/posts/annie-spratt-JMjNnQ2xFoY-unsplash_oVoYROOUTm.jpg',
            $pathUrl.'/posts/keenan-sultanik-e8KIBbJw21A-unsplash_ZleiF_ObBm.jpg',
            $pathUrl.'/posts/alain-hRwDbwef88w-unsplash__6Th8qPjSy.jpg',
            $pathUrl.'/posts/dylan-leagh-qnVXHhUP0xU-unsplash_n24nyuPFnE.jpg',
            $pathUrl.'/posts/birgith-roosipuu-hom5fPULf4I-unsplash_SFma-NCqP.jpg',
            $pathUrl.'/posts/adam-winger-ZsUbK9zSgMo-unsplash_VQ9_uwWqPd.jpg',
            $pathUrl.'/posts/halie-west-6WuPn9JfHjI-unsplash_hS3lbakFDg.jpg',
            $pathUrl.'/posts/jean-wimmerlin-IZd81d-hZ3s-unsplash_GA4xN8H0Ih.jpg',
            $pathUrl.'/posts/dylan-shaw-UQmmODoK5r0-unsplash_PKZvYNsVD1.jpg',
            $pathUrl.'/posts/dakota-corbin-PmNjS6b3XP4-unsplash_I3pnoqWHZL.jpg',
            $pathUrl.'/posts/csaba-balazs-q9URsedw330-unsplash_VncDufrcwP.jpg',
            $pathUrl.'/posts/frida-aguilar-estrada-rYWKAgO7jQg-unsplash_SWEmYE4F4h.jpg',
            $pathUrl.'/posts/benjamin-voros-U-Kty6HxcQc-unsplash_xBxhYIVSbL.jpg',
            $pathUrl.'/posts/jakob-owens-CTflmHHVrBM-unsplash_rzpRyDkDEG.jpg',
            $pathUrl.'/posts/erik-mclean-yiZW9OKHBR4-unsplash_5deUqkWOq.jpg',
        ];
    }

    protected static function getProducts() {
        $imageKitKey = env('IMAGEKIT_ID', 'ctyttbqpls');
        $pathUrl = 'https://ik.imagekit.io/'.$imageKitKey;

        return [
            $pathUrl.'/products/pexels-ryutaro-tsukata-5746107_78vEWXH9TZ.jpg',
            $pathUrl.'/products/pexels-jonathan-borba-2878740_KyD2gfNVVx.jpg',
            $pathUrl.'/products/pexels-laker-6157049_TdRJTSjR6.jpg',
            $pathUrl.'/products/pexels-anete-lusina-6331200_6lKiZXFtvb.jpg',
            $pathUrl.'/products/pexels-any-lane-5945877_dFXPcPC5__.jpg',
            $pathUrl.'/products/pexels-valeriia-miller-3151766_92XYPpJurz.jpg',
            $pathUrl.'/products/pexels-__________-____-________-____-_-______________-2587176_qrIw0Slx_.jpg',
            $pathUrl.'/products/pexels-valeriia-miller-3685523_yxWy8VagS.jpg',
            $pathUrl.'/products/pexels-sandeep-singh-7156886_iaOpTvm4ih.jpg',
            $pathUrl.'/products/pexels-pixabay-279480__2zdxc2geS.jpg',
            $pathUrl.'/products/pexels-irina-edilbaeva-2525682_I4VFPvrzM.jpg',
            $pathUrl.'/products/pexels-burst-373882_VH6RwQNYy.jpg',
        ];
    }

    protected static function getFoods() {
        $imageKitKey = env('IMAGEKIT_ID', 'ctyttbqpls');
        $pathUrl = 'https://ik.imagekit.io/'.$imageKitKey;

        return [
            $pathUrl.'/food/ronise-daluz-LgTyii0GDKQ-unsplash_cAa9n6LVw0.jpg',
            $pathUrl.'/food/anh-nguyen-kcA-c3f_3FE-unsplash_GKeXB4Wue.jpg',
            $pathUrl.'/food/lily-banse--YHSwy6uqvk-unsplash_1gXJxaPSS.jpg',
            $pathUrl.'/food/luisana-zerpa-MJPr6nOdppw-unsplash_cvYn1lo2OM.jpg',
            $pathUrl.'/food/no-revisions-gA81ZTsql68-unsplash_4ZRSNDJci.jpg',
            $pathUrl.'/food/victoria-shes-8OpyEpJVgiQ-unsplash_d97vE_BB-_.jpg',
            $pathUrl.'/food/adam-jaime-dmkmrNptMpw-unsplash_lLuIUlWHX.jpg',
            $pathUrl.'/food/eiliv-sonas-aceron-ZuIDLSz3XLg-unsplash_KmOwOHrp45.jpg',
            $pathUrl.'/food/joseph-gonzalez-fdlZBWIP0aM-unsplash_ow-idPR5M.jpg',
            $pathUrl.'/food/casey-lee-awj7sRviVXo-unsplash_iLdMWLVOj.jpg',
            $pathUrl.'/food/eaters-collective-12eHC6FxPyg-unsplash_Mm5XEi8bM.jpg',
            $pathUrl.'/food/clarissa-carbungco-uy9DJw9e_vs-unsplash_puuiPzDijR.jpg',
            $pathUrl.'/food/victoria-shes-UC0HZdUitWY-unsplash_AIgJFzvnMW.jpg',
            $pathUrl.'/food/jennifer-burk-gwBcamFtPr4-unsplash_qIfTsQxYI4.jpg',
            $pathUrl.'/food/mike-PxJ9zkM2wdA-unsplash_FD1kj5sVO.jpg',
            $pathUrl.'/food/emile-mbunzama-cLpdEA23Z44-unsplash_iyEMEEvpph.jpg',
            $pathUrl.'/food/anna-pelzer-IGfIGP5ONV0-unsplash_dhRaSwvis_.jpg',
            $pathUrl.'/food/chad-montano-eeqbbemH9-c-unsplash_SasHjbK_kS.jpg',
            $pathUrl.'/food/eiliv-sonas-aceron-uBigm8w_MpA-unsplash_BSwQqCCC1L.jpg',
            $pathUrl.'/food/alex-munsell-Yr4n8O_3UPc-unsplash_GxEsEKu9Oq.jpg',
            $pathUrl.'/food/chad-montano-MqT0asuoIcU-unsplash_iq5Cwetom.jpg',
            $pathUrl.'/food/brooke-lark-oaz0raysASk-unsplash_HRPkmsfvKr.jpg',
            $pathUrl.'/food/emy-XoByiBymX20-unsplash_av4nyqmKeX.jpg',
            $pathUrl.'/food/emile-mbunzama-cLpdEA23Z44-unsplash_1__kVvcuYmEj2.jpg',
            $pathUrl.'/food/anna-tukhfatullina-food-photographer-stylist-Mzy-OjtCI70-unsplash_Sgf3HKNl7.jpg',
            $pathUrl.'/food/emiliano-vittoriosi-OFismyezPnY-unsplash_JtPU1Yi4y.jpg',
            $pathUrl.'/food/davide-cantelli-jpkfc5_d-DI-unsplash_VjRttiI9o.jpg',
        ];
    }

    protected static function getMoviePosters() {
        $imageKitKey = env('IMAGEKIT_ID', 'ctyttbqpls');
        $pathUrl = 'https://ik.imagekit.io/'.$imageKitKey;

        return [
            $pathUrl.'/movie_posters/13_sg_Jh8syZd.webp',
            $pathUrl.'/movie_posters/14_HgHTq-gnY_.webp',
            $pathUrl.'/movie_posters/4_KhmoYpawyg.webp',
            $pathUrl.'/movie_posters/15_8WLrhy-g3.webp',
            $pathUrl.'/movie_posters/6_gZ5SOpTL6M.webp',
            $pathUrl.'/movie_posters/5_N0Ia-_Wfh.webp',
            $pathUrl.'/movie_posters/17_H5q37LZp7.webp',
            $pathUrl.'/movie_posters/18_4RGQdJKV_A.webp',
            $pathUrl.'/movie_posters/11_OaEGXWPoKK.webp',
            $pathUrl.'/movie_posters/16_Vn6bf-MJ4.webp',
            $pathUrl.'/movie_posters/2__W7nFhlp2c.webp',
            $pathUrl.'/movie_posters/20_OOGtaNYKTa.webp',
            $pathUrl.'/movie_posters/19_aU79Ft32q.webp',
            $pathUrl.'/movie_posters/12_aBuUJ25ip0.webp',
            $pathUrl.'/movie_posters/8_vwGqKhZW8.webp',
            $pathUrl.'/movie_posters/7_BuTpuxxYjD.webp',
            $pathUrl.'/movie_posters/1_47_J_m5urK.webp',
            $pathUrl.'/movie_posters/3_zE8oPNrdA.webp',
            $pathUrl.'/movie_posters/10_3Mv7Uanscu.webp',
            $pathUrl.'/movie_posters/9_xBWjyfzSp.webp',
        ];
    }

    protected static function getRestaurants() {
        $imageKitKey = env('IMAGEKIT_ID', 'ctyttbqpls');
        $pathUrl = 'https://ik.imagekit.io/'.$imageKitKey;

        return [
            $pathUrl.'/restaurants/jason-leung-poI7DelFiVA-unsplash_3JhpE2nKG-.jpg',
            $pathUrl.'/restaurants/louis-hansel-wVoP_Q2Bg_A-unsplash_UrlciHowj.jpg',
            $pathUrl.'/restaurants/maria-orlova-oMTlhdFUhdI-unsplash_-5VFi8p-JT.jpg',
            $pathUrl.'/restaurants/lycs-architecture-H77w4l3UWy4-unsplash_9Al6oB49RC.jpg',
            $pathUrl.'/restaurants/piotr-szulawski-DCmUhk54F6M-unsplash_8yjMhMav4.jpg',
            $pathUrl.'/restaurants/siyuan-g_V2rt6iG7A-unsplash_VJOnuDU7dv.jpg',
            $pathUrl.'/restaurants/shawnanggg-nmpW_WwwVSc-unsplash__Ee9g0-1ry.jpg',
            $pathUrl.'/restaurants/patrick-tomasso-GXXYkSwndP4-unsplash_rokeut0iN.jpg',
            $pathUrl.'/restaurants/andrew-seaman-sQopSb2K0CU-unsplash_3xetb6K0B3.jpg',
            $pathUrl.'/restaurants/carolina-marinelli-PkbyxvkGWcU-unsplash_y9bEY6kIN7.jpg',
            $pathUrl.'/restaurants/albert-YYZU0Lo1uXE-unsplash_eSrwqlS0zI.jpg',
            $pathUrl.'/restaurants/paul-griffin-WWST6E8LxeE-unsplash_Ymym1kCAZ.jpg',
            $pathUrl.'/restaurants/ruben-ramirez-xhKG01FN2uk-unsplash_u1cUb-mIlk.jpg',
            $pathUrl.'/restaurants/daan-evers-tKN1WXrzQ3s-unsplash_xQQqZS6DQG.jpg',
            $pathUrl.'/restaurants/igor-rand-wfM1Fi-kMaY-unsplash_AdK7nIVhr.jpg',
        ];
    }

    public static function getDefaultPeople($newPeople = []) {
        $people = self::getPeople();

        return array_replace($people, $newPeople);
    }

    public static function getDefaultAdminPeople($newAdminPeople = []) {
        $admin_people = self::getAdminPeople();

        return array_replace($admin_people, $newAdminPeople);
    }

    public static function getDefaultPosts($newPosts = []) {
        $posts = self::getPosts();

        return array_replace($posts, $newPosts);
    }

    public static function getDefaultProducts($newProducts = []) {
        $products = self::getProducts();

        return array_replace($products, $newProducts);
    }

    public static function getDefaultFoods($newFoods = []) {
        $foods = self::getFoods();

        return array_replace($foods, $newFoods);
    }

    public static function getDefaultMoviePosters($newMoviePosters = []) {
        $movies_posters = self::getMoviePosters();

        return array_replace($movies_posters, $newMoviePosters);
    }

    public static function getDefaultRestaurants($newFoods = []) {
        $foods = self::getFoods();

        return array_replace($foods, $newFoods);
    }
}
