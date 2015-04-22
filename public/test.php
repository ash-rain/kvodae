<?php
$files = glob('./bg/*.*');
$file = array_rand($files);
$source_file = $files[$file];

// histogram options
$maxheight = 300;
$barwidth = 4;

$im = ImageCreateFromJpeg($source_file);

$imgw = imagesx($im);
$imgh = imagesy($im);

// n = total number or pixels
$n = $imgw*$imgh;

$histo = array();

for ($i=0; $i<$imgw; $i++)
{
        for ($j=0; $j<$imgh; $j++)
        {
                // get the rgb value for current pixel
                $rgb = ImageColorAt($im, $i, $j);

                // extract each value for r, g, b
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                // get the Value from the RGB value
                $V = round(($r + $g + $b) / 3);

                // add the point to the histogram
                $histo[$V]['value'] += $V / $n;
                $histo[$V]['rgb'] = compact('r', 'g', 'b');
        }
}

// find the maximum in the histogram in order to display a normated graph
$max = 0;
$dom = [];
for ($i=0; $i<255; $i++) {
        if ($histo[$i]['value'] > $max) {
                $max = $histo[$i]['value'];
                $dom = $histo[$i]['rgb'];
        }
}

function hex($rgb) {
        extract($rgb);
        $hex = '#';
        $hex.= str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
        $hex.= str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
        $hex.= str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
        return $hex;
}

function colorbox($rgb, $fg) {
        extract($rgb);
        $hex = is_array($rgb) ? hex($rgb) : $rgb;
        echo "<div style='text-align: center; height: 60px; margin-bottom: 2em; border: 5px double #fff;";
        if(is_array($rgb)) echo "background-color: rgb($r, $g, $b);'>";
        if(is_string($rgb)) echo "background-color: $rgb;'>";
        echo '<h2 style="color: ', $fg, ';">Test</h2>', $hex, '</div>';
}

$com = '#';
$hex = hex($dom);
for($i=0; $i<6; $i++) {
        $com .= dechex(15 - hexdec($hex[$i]));
}
?>
<table cellspacing="7" width="100%">
        <tr>
                <td colspan="2" style="background: #000;">
<?php
echo "<div style='width: ".(256 * $barwidth)."px; margin: 0 auto;'>";
for ($i=0; $i<255; $i++)
{
        $val += $histo[$i]['value'];
        $h = ($histo[$i]['value'] / $max) * $maxheight;
        echo "<div style=\"width: {$barwidth}px; height: {$h}px; margin-top: ".(300-$h)."px; float: left; background: " . hex($histo[$i][rgb]) . ';"></div>';
}
echo "<br style='clear: both;'/>";
echo "</div>";
?>
                </td>
        </tr>
        <tr>
                <td width="<?= $imgw ?>">
                        <img src="<?php echo $source_file ?>" />
                </td>
                <td align="center">
                        <h2>Color Info</h2>
                        <h3>Max</h3>
                        <?= $max ?>
                        <h3>Dominant</h3>
                        <?php colorbox($dom, $com); ?>
                        <h3>Complementary</h3>
                        <?php colorbox($com, $hex); ?>
             </td>
        </tr>
</table>