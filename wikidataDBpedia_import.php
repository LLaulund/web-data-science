<?php
	require_once('sparqllib.php');
	class SPARQLQueryDispatcher
	{
		private $endpointUrl;

		public function __construct(string $endpointUrl)
		{
			$this->endpointUrl = $endpointUrl;
		}

		public function query(string $sparqlQuery): array
		{

			$opts = [
				'http' => [
					'method' => 'GET',
					'header' => [
						'Accept: application/sparql-results+json',
						'User-Agent: WDQS-example PHP/' . PHP_VERSION,
					],
				],
			];
			$context = stream_context_create($opts);

			$url = $this->endpointUrl . '?query=' . urlencode($sparqlQuery);
			$response = file_get_contents($url, false, $context);
			return json_decode($response, true);
		}
	}

$endpointUrl = 'https://query.wikidata.org/sparql';
$sparqlQueryString = <<< 'SPARQL'
SELECT ?subOrchid ?pic ?subOrchidLabel WHERE {
	SERVICE wikibase:label { bd:serviceParam wikibase:language "[AUTO_LANGUAGE],en". }
	
	?subOrchid wdt:P171 wd:Q25308.
	?subOrchid wdt:P18 ?pic
	
  }
  ORDER BY DESC(?subOrchid)
  LIMIT 9
SPARQL;

$queryDispatcher = new SPARQLQueryDispatcher($endpointUrl);
$queryResult = $queryDispatcher->query($sparqlQueryString);

$resultat = $queryResult; 

	for ($i=0; $i<count($resultat['results']['bindings']); $i++) {	
		$ressourse = $resultat['results']['bindings'][$i]['subOrchidLabel']['value'];
		$img = $resultat['results']['bindings'][$i]['pic']['value'];
		
		$db = sparql_connect('https://dbpedia.org/sparql');
			$query1 = "
			PREFIX dbo:<http://dbpedia.org/ontology/>
			SELECT ?Beskrivelse
			WHERE {
			<http://dbpedia.org/resource/".$ressourse."> dbo:abstract ?Beskrivelse .
			FILTER(lang(?Beskrivelse )='en') .
			}
			";
		$counter=0;
		if ($result = sparql_query($query1)){
			$fields = sparql_field_array($result);
			
			while($row= sparql_fetch_array($result)){
				
				foreach($fields as $field){
					
					$str = $row[$field];
					echo '<article class="grid-item">
					<figure><img class="img-grid-item" src="'.$img.'" /></figure>
					<h3>'.$ressourse.'</h3><br>
					<div class="content">'.substr($str,0,300).' [...] <br></div>
						<button class="btn--block">
						<a href="https://en.wikipedia.org/wiki/'.$ressourse.'">Gå til siden </a>
						</button>
					</article>';

					$counter++;	
				}
				if($counter==6){break;}
			}
		};
	}	
?>	
    
