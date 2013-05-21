<?php

/* misc/facebook.html.twig */
class __TwigTemplate_7e1c112f544b71ba5edc56d3c8816878 extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"floatbox\">
    <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border:none;\">
        <tr>
            <td width=\"33%\" valign=\"top\">
                <script type=\"text/javascript\" src=\"http://widgets.twimg.com/j/2/widget.js\"></script>
                <script type=\"text/javascript\">
                    new TWTR.Widget({
                        version: 2,
                        type: 'profile',
                        rpp: 30,
                        interval: 6000,
                        width: 'auto',
                        height: 300,
                        theme: {
                            shell: {
                                background: '#333333',
                                color: '#ffffff'
                            },
                            tweets: {
                                background: '#000000',
                                color: '#ffffff',
                                links: '#4aed05'
                            }
                        },
                        features: {
                            scrollbar: true,
                            loop: false,
                            live: true,
                            hashtags: true,
                            timestamp: false,
                            avatars: false,
                            behavior: 'all'
                        }
                    }).render().setUser('mercadomotor').start();
                </script>
            </td>
            <td width=\"33%\" valign=\"top\">
                <iframe 
                    src=\"http://www.facebook.com/plugins/likebox.php?href=http://www.facebook.com/mercadomotor&amp;width=335&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=true&amp;header=true&amp;height=400\" 
                    scrolling=\"no\" frameborder=\"0\" 
                    style=\"border:none; overflow:hidden; width: 335px; height: 400px;\">
                </iframe>
            </td>
            <td width=\"33%\" valign=\"top\">
                <iframe 
                    src=\"http://www.facebook.com/plugins/recommendations.php?site=mercadomotor.com.ve&amp;width=335&amp;height=400&amp;header=true&amp;colorscheme=light&amp;font&amp;border_color\" 
                    scrolling=\"no\" frameborder=\"0\" 
                    style=\"border:none; overflow:hidden; width: 335px; height: 400px;\">
                </iframe>
            </td>
        </tr>
    </table>
</div>";
    }

    public function getTemplateName()
    {
        return "misc/facebook.html.twig";
    }

}
