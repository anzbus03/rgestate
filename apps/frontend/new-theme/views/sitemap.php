<?php
// Set the content type to text/html so that the browser renders it as an HTML page
header('Content-Type: text/html');
?>

<style>
    body{
        margin: 0px;
        font: 14px 'Open Sans', Helvetica, Arial, sans-serif;
    }
    h1 {
        margin: 0;
        font-size: 40px;
    }
    #content{
        padding: 10px 30px 30px;
        background: #fff;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        padding: 12px 15px;
        text-align: left;
    }
    th {
        background-color: #4CAF50;
        color: #ffffff;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 12px;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:nth-child(odd) {
        background-color: #f1f1f1;
    }
    tr:hover {
        background-color: #ddd;
    }
    a {
        color: #3498db;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
    }
    .footer {
        margin-top: 30px;
        font-size: 12px;
        color: #999;
        text-align: center;
    }
    table{
        display: table;
        border-collapse: separate;
        box-sizing: border-box;
        text-indent: initial;
        unicode-bidi: isolate;
        line-height: normal;
        font-weight: normal;
        font-size: medium;
        font-style: normal;
        color: -internal-quirk-inherit;
        text-align: start;
        border-spacing: 2px;
        border-color: gray;
        white-space: normal;
        font-variant: normal;
    }
    tbody{
        display: table-row-group;
        vertical-align: middle;
        unicode-bidi: isolate;
        border-color: inherit;
    }
    tr{
        display: table-row;
        vertical-align: inherit;
        unicode-bidi: isolate;
        border-color: inherit;
    }
    .odd {
        background: linear-gradient(159.87deg, #f6f6f4 7.24%, #f7f4ea 64.73%, #ddedd5 116.53%);
    }
</style>

<div class='container' style="padding: 0px;">
    <div style="background-color: #f0f2eb; color: #000; padding: 30px 30px 20px;">
        <h1>Sitemap XML Files</h1>
        <p class='description'>
            This is an XML Sitemap Index generated for search engines like
            <a href='https://www.google.com/' target='_blank'>Google</a> or
            <a href='https://www.bing.com/' target='_blank'>Bing</a>.
            You can find more information on XML sitemaps at
            <a href='https://www.sitemaps.org/' target='_blank'>sitemaps.org</a>.
        </p>
    </div>
    
    <div id='content'>
        <table>
            <tbody>
                <tr>
                    <th>#</th>
                    <th>Sitemap URL</th>
                    <th>Last Modified</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>
                        <a href='https://rgestate.com/sitemap.xml'>
                            https://rgestate.com/sitemap.xml
                        </a>
                    </td>
                    <td><?php echo '2024-09-17'; ?></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <a href='https://rgestate.com/property-for-sale.xml'>
                            https://rgestate.com/property-for-sale.xml
                        </a>
                    </td>
                    <td><?php echo '2024-09-17'; ?></td>
                </tr>
                
                <tr>
                    <td>3</td>
                    <td>
                        <a href='https://rgestate.com/property-for-rent.xml'>
                            https://rgestate.com/property-for-rent.xml
                        </a>
                    </td>
                    <td><?php echo '2024-09-17'; ?></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>
                        <a href='https://rgestate.com/preleased.xml'>
                            https://rgestate.com/preleased.xml
                        </a>
                    </td>
                    <td><?php echo '2024-09-17'; ?></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>
                        <a href='https://rgestate.com/projects.xml'>
                            https://rgestate.com/projects.xml
                        </a>
                    </td>
                    <td><?php echo '2024-09-17'; ?></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>
                        <a href='https://rgestate.com/business-opportunities.xml'>
                            https://rgestate.com/business-opportunities.xml
                        </a>
                    </td>
                    <td><?php echo '2024-09-17'; ?></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>
                        <a href='https://rgestate.com/blog.xml'>
                            https://rgestate.com/blog.xml
                        </a>
                    </td>
                    <td><?php echo '2024-09-17'; ?></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>
                        <a href='https://rgestate.com/area-guides.xml'>
                            https://rgestate.com/area-guides.xml
                        </a>
                    </td>
                    <td><?php echo '2024-09-17'; ?></td>
                </tr>
                
            </tbody>
        </table>
    </div>
    
    <p class='footer'>
        Generated by <a href='https://www.rgestate.com/' target='_blank'>rgestate.com</a>.
    </p>
</div>
