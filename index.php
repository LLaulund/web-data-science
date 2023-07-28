<!DOCTYPE html>
<html lang="da-DK">
<head>
    <title>llaul18 - Orkideuniverset</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   

    <!-- Import af stylescheet -->
    <link href="https://lamp3.sdu.dk/~llaul18/linkeddata/mashup_style.css" rel="stylesheet" type="text/css">
    
    <!-- Import af google fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap');
    </style>

    <!-- Import af jQuery biblotek -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- Schema opmærkning af webpage -->
    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "Orkideuniverset",
        "description": "Orkideuniverset er en nyhedside for alle jer orkideentusiaster, som gerne vil holde jer opdateret på de seneste nyhedsartikler, billeder, videoer og blokposts om ordideer.",
        "author": {
        "@type": "Person",
        "name": "Lærke Helene Hartmann Laulund"
            }
    }
    </script>

    <!-- New York Times - API -->
    <script type="text/javascript" src="NewYorkTimes_import.js"></script>
    

    <!-- The guardian - api -->
    <script type="text/javascript" src="theguardian_import.js"></script>
    
        
    <!-- YouTube - API  -->
    <script type="text/javascript" src="youtube_import.js"></script>
    

    <!-- Reddit - API  -->
    <script type="text/javascript" src="reddit_import.js"></script>
    

    <!-- Wikipeadia - API -->
    <script type="text/javascript" src="wikipedia_import.js"></script>
    

</head>

<body>
   
    <section id="pagecontainer">
        <header>          
            <div class="headercontent" id="headerContent">
                <h1>Orkideuniverset</h1>
                <br><br>
                <p>Velkommen til Orkideuniverset. Orkideuniverset er en nyhedside for alle jer orkideentusiaster, <br> som gerne vil holde jer opdateret på de seneste nyhedsartikler, billeder, videoer og blokposts om ordideer.</p>
                
            </div>
        </header>
        <main class="grid-container">
            
            <!-- The Guardian og New York Times -->
            <section class="artikler">
                <h2>Artikler</h2>
                <div class="innerContainer" id="artikler">
                
                </div>
            </section>

            <!-- Unsplash -->
            <section class="billeder">
                <h2>Billeder</h2>
                <div class="innerContainer" id="billder">          
                    <?php include 'unsplash_import.php';?>         
                </div>
            </section>

            <!-- YouTube -->
            <section class="video">
                <h2>Youtube Videoer</h2>
                <div class="innerContainer" id="video">
                    
                </div>
            </section>

            <!-- Wikidata og DBpedia -->
            <section class="wikidata_dbpedia">
                <h2> Wikidata</h2>
                <div class="innerContainer">
                    <?php include 'wikidataDBpedia_import.php';?>
                </div>
            </section>

            <!-- Wikipedia infoboks -->
            <section class="wiki">
                <h2>Wiki infoboks</h2>
                <div class="innerContainer">
                    <tabel class="grid-item" id="infobox" style=" padding-left: 5%;"></tabel>
                </div>
            </section>

            <!-- Reddit -->
            <section class="reddit">
                <h2>Reddit opslag</h2>
                <div class="innerContainer" id="reddit">
                    
                </div>
            </section>

            <!-- Twitter -->
            <section class="twitter">
                <h2>Twitter opslag</h2>
                <div class="innerContainer" id="twitter">
                    <?php include 'twitter_import.php';?>
                </div>
            </section>

             <!-- RSS -->
            <section class="rss">
                <h2>Blogposts</h2>
                <div class="innerContainer" id="rss">
                    <?php include 'rss_import.php';?>
                </div>
            </section>

        </main>

    </section>
    
</body>

</html>