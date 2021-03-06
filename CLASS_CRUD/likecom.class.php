<?php
// CRUD LIKECOM (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class LIKECOM
{	
	/**
	 * get_1LikeCom Permet de récupérer un seul like de commentaire en base de donnée
	 *
	 * @param  string $numMemb
	 * @param  string $numSeqCom
	 * @param  string $numArt
	 * @return void Renvoie un object comprenant les informations du like de commentaire récupéré
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_1LikeCom(string $numMemb, string $numSeqCom, string $numArt)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM likecom WHERE numMemb=:numMemb AND numSeqCom=:numSeqCom AND numArt=:numArt");
		$query->execute([
			'numMemb' => $numMemb,
			'numSeqCom' => $numSeqCom,
			'numArt' => $numArt
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllLikesCom Permet de récupérer tous les likes de commentaire en base de donnée
	 *
	 * @return void Renvoie un tableau d'object comprenant les informations de tous les like de commentaire
	 */
	function get_AllLikesCom()
	{
		global $db;
		$query = $db->query('SELECT * FROM likecom');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllLikesComByComment Permet de récupérer tous les likes d'un commentaire
	 *
	 * @param  string $numSeqCom
	 * @param  string $numArt
	 * @return void Renvoie un tableau d'object comprenant les informations de tous les likes récupérés
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_AllLikesComByComment(string $numSeqCom, string $numArt)
	{
		global $db;
		$query = $db->prepare('SELECT * FROM likecom WHERE numSeqCom = :numSeqCom AND numArt = :numArt AND likeC = 1');
		$query->execute([
			'numSeqCom' => $numSeqCom,
			'numArt' => $numArt
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllLikesComByMembre Permet de récupérer tous les likes d'un membre
	 *
	 * @param  string $numMemb
	 * @return array Renvoie un tableau d'object comprenant les informations de tous les likes récupérés
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_AllLikesComByMembre(string $numMemb)
	{
		global $db;
		$query = $db->prepare('SELECT * FROM likecom WHERE numMemb = :numMemb');
		$query->execute([
			'numMemb' => $numMemb
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return ($result);
	}

	function isMembreLikeComment(string $numMemb, string $numSeqCom, string $numArt): bool
	{
		global $db;
		$query = $db->prepare('SELECT * FROM likecom WHERE numMemb = :numMemb AND numSeqCom=:numSeqCom AND numArt=:numArt AND likeC = 1');
		$query->execute([
			'numMemb' => $numMemb,
			'numSeqCom' => $numSeqCom,
			'numArt' => $numArt
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result ? true : false;
	}

		
	/**
	 * createOrUpdate Permet d'ajouter un like de commentaire en base de donnée ou de modifier son état s'il existe déjà
	 *
	 * @param  string $numMemb
	 * @param  string $numSeqCom
	 * @param  string $numArt
	 * @return void
	 */
	function createOrUpdate(string $numMemb, string $numSeqCom, string $numArt)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('INSERT INTO likecom (numMemb, numSeqCom, numArt, likeC) VALUES (:numMemb, :numSeqCom, :numArt, 1) ON DUPLICATE KEY UPDATE likeC = !likeC');
			$query->execute([
				'numMemb' => $numMemb,
				'numSeqCom' => $numSeqCom,
				'numArt' => $numArt
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur insertOrUpdate LIKECOM : ' . $e->getMessage());
		}
	}
}	// End of class
