DELIMITER $$

DROP PROCEDURE IF EXISTS communes_near $$
CREATE PROCEDURE communes_near( IN commune_ref VARCHAR(255), IN distance_commune INT, OUT oid VARCHAR(1024))


BEGIN
	DECLARE latitude_commune_ref FLOAT;
	DECLARE longitude_commune_ref FLOAT;
	DECLARE lon1 FLOAT;
	DECLARE lon2 FLOAT;
	DECLARE lat1 FLOAT;
	DECLARE lat2 FLOAT;
	


	
	SELECT lat,lng INTO latitude_commune_ref,longitude_commune_ref FROM communes WHERE nom = commune_ref LIMIT 1;
	SET lon1 = longitude_commune_ref - distance_commune/abs(cos(radians(latitude_commune_ref))*111.1);
	SET lon2 =longitude_commune_ref+distance_commune/abs(cos(radians(latitude_commune_ref))*111.1);
	SET lat1 =latitude_commune_ref -(distance_commune/111.1);
	SET lat2=latitude_commune_ref+(distance_commune/111.1);
	SELECT GROUP_CONCAT(CONCAT("\"",id,"\"")) 
		INTO oid FROM communes  
		
		WHERE communes.lng BETWEEN lon1 and lon2
		AND communes.lat BETWEEN lat1 and lat2
		AND ( 6371 * acos( cos( radians(latitude_commune_ref) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(longitude_commune_ref) ) + sin( radians(latitude_commune_ref) ) * sin( radians( lat ) ) ) ) < distance_commune;
	
END$$

DELIMITER ;

CALL communes_near("CAVAILLON",10,@list_id);

SELECT @list_id;

---------------------------------------------------------------------
DELIMITER $$

DROP PROCEDURE IF EXISTS communes_near2 $$
CREATE PROCEDURE communes_near2( IN commune_ref TEXT, IN distance_commune INT)


BEGIN
	DECLARE latitude_commune_ref FLOAT;
	DECLARE longitude_commune_ref FLOAT;
	DECLARE lon1 FLOAT;
	DECLARE lon2 FLOAT;
	DECLARE lat1 FLOAT;
	DECLARE lat2 FLOAT;
	


	
	SELECT lat,lng INTO latitude_commune_ref,longitude_commune_ref FROM communes WHERE nom = commune_ref LIMIT 1;
	SET lon1 = longitude_commune_ref - distance_commune/abs(cos(radians(latitude_commune_ref))*111.1);
	SET lon2 =longitude_commune_ref+distance_commune/abs(cos(radians(latitude_commune_ref))*111.1);
	SET lat1 =latitude_commune_ref -(distance_commune/111.1);
	SET lat2=latitude_commune_ref+(distance_commune/111.1);
	SELECT GROUP_CONCAT(CONCAT("\"",id,"\"")) as communes_list
		 FROM communes  
		
		WHERE communes.lng BETWEEN lon1 and lon2
		AND communes.lat BETWEEN lat1 and lat2
		AND ( 6371 * acos( cos( radians(latitude_commune_ref) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(longitude_commune_ref) ) + sin( radians(latitude_commune_ref) ) * sin( radians( lat ) ) ) ) < distance_commune;
	
END$$

DELIMITER ;

CALL communes_near2("CAVAILLON",10);
