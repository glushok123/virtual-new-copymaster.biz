	<script>
        var cura=0,curb=0;
        var p=[[],[0,0,<?$g_files = scandir("posters/1");$g_count = count($g_files);echo "\"".$g_files[2]."\"";for ($i=3; $i<$g_count ; $i++) {echo ','."\"".$g_files[$i]."\"";}?>],[0,0,<?$g_files = scandir("posters/2");$g_count = count($g_files);echo "\"".$g_files[2]."\"";for ($i=3; $i<$g_count ; $i++) {echo ','."\"".$g_files[$i]."\"";}?>],[0,0,<?$g_files = scandir("posters/3");$g_count = count($g_files);echo "\"".$g_files[2]."\"";for ($i=3; $i<$g_count ; $i++) {echo ','."\"".$g_files[$i]."\"";}?>],[0,0,<?$g_files = scandir("posters/4");$g_count = count($g_files);echo "\"".$g_files[2]."\"";for ($i=3; $i<$g_count ; $i++) {echo ','."\"".$g_files[$i]."\"";}?>],[0,0,<?$g_files = scandir("posters/5");$g_count = count($g_files);echo "\"".$g_files[2]."\"";for ($i=3; $i<$g_count ; $i++) {echo ','."\"".$g_files[$i]."\"";}?>],[0,0,<?$g_files = scandir("posters/6");$g_count = count($g_files);echo "\"".$g_files[2]."\"";for ($i=3; $i<$g_count ; $i++) {echo ','."\"".$g_files[$i]."\"";}?>],[0,0,<?$g_files = scandir("posters/7");$g_count = count($g_files);echo "\"".$g_files[2]."\"";for ($i=3; $i<$g_count ; $i++) {echo ','."\"".$g_files[$i]."\"";}?>],[0,0,<?$g_files = scandir("posters/8");$g_count = count($g_files);echo "\"".$g_files[2]."\"";for ($i=3; $i<$g_count ; $i++) {echo ','."\"".$g_files[$i]."\"";}?>],[0,0,<?$g_files = scandir("posters/9");$g_count = count($g_files);echo "\"".$g_files[2]."\"";for ($i=3; $i<$g_count ; $i++) {echo ','."\"".$g_files[$i]."\"";}?>]];

        window.addEventListener('keydown', handler, false);

        function handler(event) {
            if (document.getElementById("galview").className=="galshow") {
                if (event.keyCode==37) { galprev(); }
                if (event.keyCode==39) { galnext(); }
            }
        }

        function showgallery (id) {
            for (i=1; i<10; i++) {
                if (id==i) {
                    document.getElementById("gal"+i).className = "galleryshow";
                }
                else {
                    document.getElementById("gal"+i).className = "galleryhide";
                }
            }
            document.getElementById("galleryshade").className = "galleryshadeshow";
        }

        function hidegallery () {
            for (i=1; i<10; i++) {
                document.getElementById("gal"+i).className = "galleryhide";
            }
            document.getElementById("galleryshade").className = "galleryshadehide";
        }

        function galview(a,b) {
            if (a==0) {
                document.getElementById("galview").className="galhide";
                document.getElementById("galviewshade").className="galviewshadehide";
                document.getElementById("gal_right").className="galrighthide";
                document.getElementById("gal_left").className="gallefthide";
            }
            else {
                cura=a;
                curb=b;
                document.getElementById("galview").title=(p[a][b].split('.'))[0];
                document.getElementById("galview").style.cssText = "background:url('posters/"+a+"/"+p[a][b]+"') center no-repeat, url('posters/"+a+"/"+p[a][b+1]+"') 2000px 2000px no-repeat, url('posters/"+a+"/"+p[a][b-1]+"') 2000px 2000px no-repeat ; background-size:contain;";
                document.getElementById("galview").className="galshow";
                document.getElementById("galviewshade").className="galviewshadeshow";
                document.getElementById("gal_right").className="galrightshow";
                document.getElementById("gal_left").className="galleftshow";
            }
        }

        function galprev() {
            curb<3?curb=(p[cura].length-1):curb--;
            document.getElementById("galview").title=(p[cura][curb].split('.'))[0];
            document.getElementById("galview").style.cssText = "background:url('posters/"+cura+"/"+p[cura][curb]+"') center no-repeat, url('posters/"+cura+"/"+p[cura][curb+1]+"') 2000px 2000px no-repeat, url('posters/"+cura+"/"+p[cura][curb-1]+"') 2000px 2000px no-repeat; background-size:contain;";
        }

        function galnext() {
            curb>p[cura].length-2?curb=2:curb++;
            document.getElementById("galview").title=(p[cura][curb].split('.'))[0];
            document.getElementById("galview").style.cssText = "background:url('posters/"+cura+"/"+p[cura][curb]+"') center no-repeat, url('posters/"+cura+"/"+p[cura][curb+1]+"') 2000px 2000px no-repeat, url('posters/"+cura+"/"+p[cura][curb-1]+"') 2000px 2000px no-repeat; background-size:contain;";
        }

    </script>

    <div id="galviewshade" class="galviewshadehide" onclick="galview(0)"></div>
    <div id="galview" class="galhide" onclick="galview(0)"></div>
    <div id="gal_left" onclick="galprev()" class="gallefthide"></div>
    <div id="gal_right" onclick="galnext()" class="galrighthide"></div>

    <div id="galleryshade" class="galleryshadehide" title="Закрыть" onclick="hidegallery()" ></div>
    <?
        for ($j=1; $j<10; $j++) {
            echo '<div id="gal'.$j.'" class="galleryhide">';
            echo '
                <div style="background:#fff; height:100px;">
                    <div title="Абстракции" class="galhead1" onclick="showgallery (1)"></div>
                    <div title="Архитектура" class="galhead2" onclick="showgallery (2)"></div>
                    <div title="Девушки" class="galhead3" onclick="showgallery (3)"></div>
                    <div title="Еда" class="galhead4" onclick="showgallery (4)"></div>
                    <div title="Животные" class="galhead5" onclick="showgallery (5)"></div>
                    <div title="Мужчины" class="galhead6" onclick="showgallery (6)"></div>
                    <div title="Новый год" class="galhead7" onclick="showgallery (7)"></div>
                    <div title="Природа" class="galhead8" onclick="showgallery (8)"></div>
                    <div title="Разное" class="galhead9" onclick="showgallery (9)"></div>
                    <div title="Закрыть галерею" class="galhead0" onclick="hidegallery()"></div>
                </div>
            ';

            $g_files = scandir("posters/".$j);
            $g_count = count($g_files);
            for ($i=2; $i<$g_count ; $i++) {
                $art=explode(".",$g_files[$i]);
                echo "<div class='galem' title='Артикул: ".$art[0]."' style='background:url(\"/posters/".$j."s/".$g_files[$i]."\"); ' onclick='galview(".$j.",".$i.")'></div>";
            }
            echo "</div>";
         }
    ?>

