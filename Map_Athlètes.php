<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nombre d'Athlètes par Pays</title>
    <script src="https://d3js.org/d3.v6.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/topojson@3"></script>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            margin-top: 20px;
            color: #333;
        }

        #map {
            display: block;
            margin: 0 auto;
            background-color: #eaeaea;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .country {
            stroke: #ffffff;
            stroke-width: 0.5;
        }

        .legend {
            font-size: 12px;
            fill: #333;
        }

        .tooltip {
            position: absolute;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 8px;
            border-radius: 5px;
            font-size: 0.9rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            pointer-events: none;
            visibility: hidden;
        }
    </style>
</head>
<body>
    <h1>Nombre d'Athlètes par Pays</h1>
    <svg id="map" width="960" height="600"></svg>
    <div class="tooltip" id="tooltip"></div>

    <script>
        // Charger les données nécessaires
        Promise.all([
            d3.json("https://cdn.jsdelivr.net/npm/world-atlas@2/countries-110m.json"), // Fichier TopoJSON
            d3.csv("archive/athletes.csv") // Fichier CSV
        ]).then(([world, data]) => {
            const svg = d3.select("#map");
            const tooltip = d3.select("#tooltip");
            const width = +svg.attr("width");
            const height = +svg.attr("height");

            // Prétraitement des données CSV
            data.forEach(d => {
                // Remplacer "USA" par "United States of America" dans la colonne country
                if (d.country === "United States") {
                    d.country = "United States of America";
                }
            });

            const athletesByCountry = d3.rollup(
                data,
                v => v.length,
                d => d.country
            );

            // Calculer les limites des valeurs pour le remplissage
            const maxAthletes = d3.max(Array.from(athletesByCountry.values()));

            // Échelle de couleurs
            const colorScale = d3.scaleSequential()
                .domain([0, maxAthletes])
                .interpolator(d3.interpolateBlues);

            // Conversion TopoJSON en GeoJSON
            const countries = topojson.feature(world, world.objects.countries).features;

            // Projeter la carte
            const projection = d3.geoNaturalEarth1().scale(150).translate([width / 2, height / 2]);
            const path = d3.geoPath().projection(projection);

            // Ajouter les pays à la carte
            svg.selectAll(".country")
                .data(countries)
                .enter()
                .append("path")
                .attr("class", "country")
                .attr("d", path)
                .attr("fill", d => {
                    const countryName = d.properties.name;
                    const athleteCount = athletesByCountry.get(countryName) || 0;
                    return colorScale(athleteCount);
                })
                .on("mouseover", (event, d) => {
                    const countryName = d.properties.name;
                    const athleteCount = athletesByCountry.get(countryName) || 0;
                    tooltip.style("visibility", "visible")
                        .text(`${countryName}: ${athleteCount} athlète(s)`)
                        .style("top", `${event.pageY - 10}px`)
                        .style("left", `${event.pageX + 10}px`);
                })
                .on("mousemove", (event) => {
                    tooltip.style("top", `${event.pageY - 10}px`)
                        .style("left", `${event.pageX + 10}px`);
                })
                .on("mouseout", () => {
                    tooltip.style("visibility", "hidden");
                });

            // Ajouter une légende
            const legendWidth = 300;
            const legendHeight = 20;

            const legendGroup = svg.append("g")
                .attr("transform", `translate(${width - legendWidth - 50}, ${height - 50})`);

            const legendScale = d3.scaleLinear()
                .domain([0, maxAthletes])
                .range([0, legendWidth]);

            const legendAxis = d3.axisBottom(legendScale)
                .ticks(5)
                .tickSize(-legendHeight);

            const gradient = svg.append("defs")
                .append("linearGradient")
                .attr("id", "gradient")
                .attr("x1", "0%")
                .attr("x2", "100%")
                .attr("y1", "0%")
                .attr("y2", "0%");

            gradient.append("stop")
                .attr("offset", "0%")
                .attr("stop-color", colorScale(0));

            gradient.append("stop")
                .attr("offset", "100%")
                .attr("stop-color", colorScale(maxAthletes));

            legendGroup.append("rect")
                .attr("width", legendWidth)
                .attr("height", legendHeight)
                .style("fill", "url(#gradient)");

            legendGroup.append("g")
                .attr("transform", `translate(0, ${legendHeight})`)
                .call(legendAxis)
                .select(".domain").remove();
        }).catch(error => {
            console.error("Erreur lors du chargement des données :", error);
        });
    </script>
    <br>
    <div style="text-align: center; margin-top: 20px;">
    <a href="repartition_age.php">Retour au diagramme</a>
</div>

</body>
</html>
