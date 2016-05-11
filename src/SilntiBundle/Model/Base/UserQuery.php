<?php

namespace SilntiBundle\Model\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use SilntiBundle\Model\User as ChildUser;
use SilntiBundle\Model\UserQuery as ChildUserQuery;
use SilntiBundle\Model\Map\UserTableMap;

/**
 * Base class that represents a query for the 'user' table.
 *
 *
 *
 * @method     ChildUserQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildUserQuery orderByNom($order = Criteria::ASC) Order by the nom column
 * @method     ChildUserQuery orderByPrenom($order = Criteria::ASC) Order by the prenom column
 * @method     ChildUserQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUserQuery orderByMdp($order = Criteria::ASC) Order by the mdp column
 * @method     ChildUserQuery orderByTel($order = Criteria::ASC) Order by the tel column
 * @method     ChildUserQuery orderByDroit($order = Criteria::ASC) Order by the droit column
 * @method     ChildUserQuery orderByPhoto($order = Criteria::ASC) Order by the photo column
 *
 * @method     ChildUserQuery groupByIdUser() Group by the id_user column
 * @method     ChildUserQuery groupByNom() Group by the nom column
 * @method     ChildUserQuery groupByPrenom() Group by the prenom column
 * @method     ChildUserQuery groupByEmail() Group by the email column
 * @method     ChildUserQuery groupByMdp() Group by the mdp column
 * @method     ChildUserQuery groupByTel() Group by the tel column
 * @method     ChildUserQuery groupByDroit() Group by the droit column
 * @method     ChildUserQuery groupByPhoto() Group by the photo column
 *
 * @method     ChildUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserQuery leftJoinActualite($relationAlias = null) Adds a LEFT JOIN clause to the query using the Actualite relation
 * @method     ChildUserQuery rightJoinActualite($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Actualite relation
 * @method     ChildUserQuery innerJoinActualite($relationAlias = null) Adds a INNER JOIN clause to the query using the Actualite relation
 *
 * @method     ChildUserQuery joinWithActualite($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Actualite relation
 *
 * @method     ChildUserQuery leftJoinWithActualite() Adds a LEFT JOIN clause and with to the query using the Actualite relation
 * @method     ChildUserQuery rightJoinWithActualite() Adds a RIGHT JOIN clause and with to the query using the Actualite relation
 * @method     ChildUserQuery innerJoinWithActualite() Adds a INNER JOIN clause and with to the query using the Actualite relation
 *
 * @method     ChildUserQuery leftJoinEnseigner($relationAlias = null) Adds a LEFT JOIN clause to the query using the Enseigner relation
 * @method     ChildUserQuery rightJoinEnseigner($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Enseigner relation
 * @method     ChildUserQuery innerJoinEnseigner($relationAlias = null) Adds a INNER JOIN clause to the query using the Enseigner relation
 *
 * @method     ChildUserQuery joinWithEnseigner($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Enseigner relation
 *
 * @method     ChildUserQuery leftJoinWithEnseigner() Adds a LEFT JOIN clause and with to the query using the Enseigner relation
 * @method     ChildUserQuery rightJoinWithEnseigner() Adds a RIGHT JOIN clause and with to the query using the Enseigner relation
 * @method     ChildUserQuery innerJoinWithEnseigner() Adds a INNER JOIN clause and with to the query using the Enseigner relation
 *
 * @method     ChildUserQuery leftJoinEtudiant($relationAlias = null) Adds a LEFT JOIN clause to the query using the Etudiant relation
 * @method     ChildUserQuery rightJoinEtudiant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Etudiant relation
 * @method     ChildUserQuery innerJoinEtudiant($relationAlias = null) Adds a INNER JOIN clause to the query using the Etudiant relation
 *
 * @method     ChildUserQuery joinWithEtudiant($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Etudiant relation
 *
 * @method     ChildUserQuery leftJoinWithEtudiant() Adds a LEFT JOIN clause and with to the query using the Etudiant relation
 * @method     ChildUserQuery rightJoinWithEtudiant() Adds a RIGHT JOIN clause and with to the query using the Etudiant relation
 * @method     ChildUserQuery innerJoinWithEtudiant() Adds a INNER JOIN clause and with to the query using the Etudiant relation
 *
 * @method     ChildUserQuery leftJoinFichier($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fichier relation
 * @method     ChildUserQuery rightJoinFichier($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fichier relation
 * @method     ChildUserQuery innerJoinFichier($relationAlias = null) Adds a INNER JOIN clause to the query using the Fichier relation
 *
 * @method     ChildUserQuery joinWithFichier($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Fichier relation
 *
 * @method     ChildUserQuery leftJoinWithFichier() Adds a LEFT JOIN clause and with to the query using the Fichier relation
 * @method     ChildUserQuery rightJoinWithFichier() Adds a RIGHT JOIN clause and with to the query using the Fichier relation
 * @method     ChildUserQuery innerJoinWithFichier() Adds a INNER JOIN clause and with to the query using the Fichier relation
 *
 * @method     ChildUserQuery leftJoinNote($relationAlias = null) Adds a LEFT JOIN clause to the query using the Note relation
 * @method     ChildUserQuery rightJoinNote($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Note relation
 * @method     ChildUserQuery innerJoinNote($relationAlias = null) Adds a INNER JOIN clause to the query using the Note relation
 *
 * @method     ChildUserQuery joinWithNote($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Note relation
 *
 * @method     ChildUserQuery leftJoinWithNote() Adds a LEFT JOIN clause and with to the query using the Note relation
 * @method     ChildUserQuery rightJoinWithNote() Adds a RIGHT JOIN clause and with to the query using the Note relation
 * @method     ChildUserQuery innerJoinWithNote() Adds a INNER JOIN clause and with to the query using the Note relation
 *
 * @method     ChildUserQuery leftJoinPage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Page relation
 * @method     ChildUserQuery rightJoinPage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Page relation
 * @method     ChildUserQuery innerJoinPage($relationAlias = null) Adds a INNER JOIN clause to the query using the Page relation
 *
 * @method     ChildUserQuery joinWithPage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Page relation
 *
 * @method     ChildUserQuery leftJoinWithPage() Adds a LEFT JOIN clause and with to the query using the Page relation
 * @method     ChildUserQuery rightJoinWithPage() Adds a RIGHT JOIN clause and with to the query using the Page relation
 * @method     ChildUserQuery innerJoinWithPage() Adds a INNER JOIN clause and with to the query using the Page relation
 *
 * @method     ChildUserQuery leftJoinProf($relationAlias = null) Adds a LEFT JOIN clause to the query using the Prof relation
 * @method     ChildUserQuery rightJoinProf($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Prof relation
 * @method     ChildUserQuery innerJoinProf($relationAlias = null) Adds a INNER JOIN clause to the query using the Prof relation
 *
 * @method     ChildUserQuery joinWithProf($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Prof relation
 *
 * @method     ChildUserQuery leftJoinWithProf() Adds a LEFT JOIN clause and with to the query using the Prof relation
 * @method     ChildUserQuery rightJoinWithProf() Adds a RIGHT JOIN clause and with to the query using the Prof relation
 * @method     ChildUserQuery innerJoinWithProf() Adds a INNER JOIN clause and with to the query using the Prof relation
 *
 * @method     \SilntiBundle\Model\ActualiteQuery|\SilntiBundle\Model\EnseignerQuery|\SilntiBundle\Model\EtudiantQuery|\SilntiBundle\Model\FichierQuery|\SilntiBundle\Model\NoteQuery|\SilntiBundle\Model\PageQuery|\SilntiBundle\Model\ProfQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUser findOne(ConnectionInterface $con = null) Return the first ChildUser matching the query
 * @method     ChildUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUser matching the query, or a new ChildUser object populated from the query conditions when no match is found
 *
 * @method     ChildUser findOneByIdUser(int $id_user) Return the first ChildUser filtered by the id_user column
 * @method     ChildUser findOneByNom(string $nom) Return the first ChildUser filtered by the nom column
 * @method     ChildUser findOneByPrenom(string $prenom) Return the first ChildUser filtered by the prenom column
 * @method     ChildUser findOneByEmail(string $email) Return the first ChildUser filtered by the email column
 * @method     ChildUser findOneByMdp(string $mdp) Return the first ChildUser filtered by the mdp column
 * @method     ChildUser findOneByTel(string $tel) Return the first ChildUser filtered by the tel column
 * @method     ChildUser findOneByDroit(int $droit) Return the first ChildUser filtered by the droit column
 * @method     ChildUser findOneByPhoto(string $photo) Return the first ChildUser filtered by the photo column *

 * @method     ChildUser requirePk($key, ConnectionInterface $con = null) Return the ChildUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOne(ConnectionInterface $con = null) Return the first ChildUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser requireOneByIdUser(int $id_user) Return the first ChildUser filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByNom(string $nom) Return the first ChildUser filtered by the nom column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByPrenom(string $prenom) Return the first ChildUser filtered by the prenom column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByEmail(string $email) Return the first ChildUser filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByMdp(string $mdp) Return the first ChildUser filtered by the mdp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByTel(string $tel) Return the first ChildUser filtered by the tel column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByDroit(int $droit) Return the first ChildUser filtered by the droit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByPhoto(string $photo) Return the first ChildUser filtered by the photo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUser objects based on current ModelCriteria
 * @method     ChildUser[]|ObjectCollection findByIdUser(int $id_user) Return ChildUser objects filtered by the id_user column
 * @method     ChildUser[]|ObjectCollection findByNom(string $nom) Return ChildUser objects filtered by the nom column
 * @method     ChildUser[]|ObjectCollection findByPrenom(string $prenom) Return ChildUser objects filtered by the prenom column
 * @method     ChildUser[]|ObjectCollection findByEmail(string $email) Return ChildUser objects filtered by the email column
 * @method     ChildUser[]|ObjectCollection findByMdp(string $mdp) Return ChildUser objects filtered by the mdp column
 * @method     ChildUser[]|ObjectCollection findByTel(string $tel) Return ChildUser objects filtered by the tel column
 * @method     ChildUser[]|ObjectCollection findByDroit(int $droit) Return ChildUser objects filtered by the droit column
 * @method     ChildUser[]|ObjectCollection findByPhoto(string $photo) Return ChildUser objects filtered by the photo column
 * @method     ChildUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \SilntiBundle\Model\Base\UserQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SilntiBundle\\Model\\User', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserQuery) {
            return $criteria;
        }
        $query = new ChildUserQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_user, nom, prenom, email, mdp, tel, droit, photo FROM user WHERE id_user = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUser $obj */
            $obj = new ChildUser();
            $obj->hydrate($row);
            UserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildUser|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserTableMap::COL_ID_USER, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserTableMap::COL_ID_USER, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id_user column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUser(1234); // WHERE id_user = 1234
     * $query->filterByIdUser(array(12, 34)); // WHERE id_user IN (12, 34)
     * $query->filterByIdUser(array('min' => 12)); // WHERE id_user > 12
     * </code>
     *
     * @param     mixed $idUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(UserTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(UserTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the nom column
     *
     * Example usage:
     * <code>
     * $query->filterByNom('fooValue');   // WHERE nom = 'fooValue'
     * $query->filterByNom('%fooValue%'); // WHERE nom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nom The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByNom($nom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nom)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nom)) {
                $nom = str_replace('*', '%', $nom);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_NOM, $nom, $comparison);
    }

    /**
     * Filter the query on the prenom column
     *
     * Example usage:
     * <code>
     * $query->filterByPrenom('fooValue');   // WHERE prenom = 'fooValue'
     * $query->filterByPrenom('%fooValue%'); // WHERE prenom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $prenom The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPrenom($prenom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($prenom)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $prenom)) {
                $prenom = str_replace('*', '%', $prenom);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_PRENOM, $prenom, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the mdp column
     *
     * Example usage:
     * <code>
     * $query->filterByMdp('fooValue');   // WHERE mdp = 'fooValue'
     * $query->filterByMdp('%fooValue%'); // WHERE mdp LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mdp The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByMdp($mdp = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mdp)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mdp)) {
                $mdp = str_replace('*', '%', $mdp);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_MDP, $mdp, $comparison);
    }

    /**
     * Filter the query on the tel column
     *
     * Example usage:
     * <code>
     * $query->filterByTel('fooValue');   // WHERE tel = 'fooValue'
     * $query->filterByTel('%fooValue%'); // WHERE tel LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByTel($tel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel)) {
                $tel = str_replace('*', '%', $tel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_TEL, $tel, $comparison);
    }

    /**
     * Filter the query on the droit column
     *
     * Example usage:
     * <code>
     * $query->filterByDroit(1234); // WHERE droit = 1234
     * $query->filterByDroit(array(12, 34)); // WHERE droit IN (12, 34)
     * $query->filterByDroit(array('min' => 12)); // WHERE droit > 12
     * </code>
     *
     * @param     mixed $droit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByDroit($droit = null, $comparison = null)
    {
        if (is_array($droit)) {
            $useMinMax = false;
            if (isset($droit['min'])) {
                $this->addUsingAlias(UserTableMap::COL_DROIT, $droit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($droit['max'])) {
                $this->addUsingAlias(UserTableMap::COL_DROIT, $droit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_DROIT, $droit, $comparison);
    }

    /**
     * Filter the query on the photo column
     *
     * Example usage:
     * <code>
     * $query->filterByPhoto('fooValue');   // WHERE photo = 'fooValue'
     * $query->filterByPhoto('%fooValue%'); // WHERE photo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $photo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPhoto($photo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($photo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $photo)) {
                $photo = str_replace('*', '%', $photo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_PHOTO, $photo, $comparison);
    }

    /**
     * Filter the query by a related \SilntiBundle\Model\Actualite object
     *
     * @param \SilntiBundle\Model\Actualite|ObjectCollection $actualite the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByActualite($actualite, $comparison = null)
    {
        if ($actualite instanceof \SilntiBundle\Model\Actualite) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID_USER, $actualite->getIdUser(), $comparison);
        } elseif ($actualite instanceof ObjectCollection) {
            return $this
                ->useActualiteQuery()
                ->filterByPrimaryKeys($actualite->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByActualite() only accepts arguments of type \SilntiBundle\Model\Actualite or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Actualite relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinActualite($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Actualite');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Actualite');
        }

        return $this;
    }

    /**
     * Use the Actualite relation Actualite object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SilntiBundle\Model\ActualiteQuery A secondary query class using the current class as primary query
     */
    public function useActualiteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinActualite($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Actualite', '\SilntiBundle\Model\ActualiteQuery');
    }

    /**
     * Filter the query by a related \SilntiBundle\Model\Enseigner object
     *
     * @param \SilntiBundle\Model\Enseigner|ObjectCollection $enseigner the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByEnseigner($enseigner, $comparison = null)
    {
        if ($enseigner instanceof \SilntiBundle\Model\Enseigner) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID_USER, $enseigner->getIdUser(), $comparison);
        } elseif ($enseigner instanceof ObjectCollection) {
            return $this
                ->useEnseignerQuery()
                ->filterByPrimaryKeys($enseigner->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEnseigner() only accepts arguments of type \SilntiBundle\Model\Enseigner or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Enseigner relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinEnseigner($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Enseigner');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Enseigner');
        }

        return $this;
    }

    /**
     * Use the Enseigner relation Enseigner object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SilntiBundle\Model\EnseignerQuery A secondary query class using the current class as primary query
     */
    public function useEnseignerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEnseigner($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Enseigner', '\SilntiBundle\Model\EnseignerQuery');
    }

    /**
     * Filter the query by a related \SilntiBundle\Model\Etudiant object
     *
     * @param \SilntiBundle\Model\Etudiant|ObjectCollection $etudiant the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByEtudiant($etudiant, $comparison = null)
    {
        if ($etudiant instanceof \SilntiBundle\Model\Etudiant) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID_USER, $etudiant->getIdUser(), $comparison);
        } elseif ($etudiant instanceof ObjectCollection) {
            return $this
                ->useEtudiantQuery()
                ->filterByPrimaryKeys($etudiant->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEtudiant() only accepts arguments of type \SilntiBundle\Model\Etudiant or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Etudiant relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinEtudiant($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Etudiant');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Etudiant');
        }

        return $this;
    }

    /**
     * Use the Etudiant relation Etudiant object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SilntiBundle\Model\EtudiantQuery A secondary query class using the current class as primary query
     */
    public function useEtudiantQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEtudiant($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Etudiant', '\SilntiBundle\Model\EtudiantQuery');
    }

    /**
     * Filter the query by a related \SilntiBundle\Model\Fichier object
     *
     * @param \SilntiBundle\Model\Fichier|ObjectCollection $fichier the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByFichier($fichier, $comparison = null)
    {
        if ($fichier instanceof \SilntiBundle\Model\Fichier) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID_USER, $fichier->getIdUser(), $comparison);
        } elseif ($fichier instanceof ObjectCollection) {
            return $this
                ->useFichierQuery()
                ->filterByPrimaryKeys($fichier->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFichier() only accepts arguments of type \SilntiBundle\Model\Fichier or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Fichier relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinFichier($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Fichier');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Fichier');
        }

        return $this;
    }

    /**
     * Use the Fichier relation Fichier object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SilntiBundle\Model\FichierQuery A secondary query class using the current class as primary query
     */
    public function useFichierQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFichier($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Fichier', '\SilntiBundle\Model\FichierQuery');
    }

    /**
     * Filter the query by a related \SilntiBundle\Model\Note object
     *
     * @param \SilntiBundle\Model\Note|ObjectCollection $note the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByNote($note, $comparison = null)
    {
        if ($note instanceof \SilntiBundle\Model\Note) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID_USER, $note->getIdUser(), $comparison);
        } elseif ($note instanceof ObjectCollection) {
            return $this
                ->useNoteQuery()
                ->filterByPrimaryKeys($note->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNote() only accepts arguments of type \SilntiBundle\Model\Note or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Note relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinNote($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Note');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Note');
        }

        return $this;
    }

    /**
     * Use the Note relation Note object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SilntiBundle\Model\NoteQuery A secondary query class using the current class as primary query
     */
    public function useNoteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNote($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Note', '\SilntiBundle\Model\NoteQuery');
    }

    /**
     * Filter the query by a related \SilntiBundle\Model\Page object
     *
     * @param \SilntiBundle\Model\Page|ObjectCollection $page the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByPage($page, $comparison = null)
    {
        if ($page instanceof \SilntiBundle\Model\Page) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID_USER, $page->getIdUser(), $comparison);
        } elseif ($page instanceof ObjectCollection) {
            return $this
                ->usePageQuery()
                ->filterByPrimaryKeys($page->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPage() only accepts arguments of type \SilntiBundle\Model\Page or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Page relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinPage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Page');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Page');
        }

        return $this;
    }

    /**
     * Use the Page relation Page object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SilntiBundle\Model\PageQuery A secondary query class using the current class as primary query
     */
    public function usePageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Page', '\SilntiBundle\Model\PageQuery');
    }

    /**
     * Filter the query by a related \SilntiBundle\Model\Prof object
     *
     * @param \SilntiBundle\Model\Prof|ObjectCollection $prof the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByProf($prof, $comparison = null)
    {
        if ($prof instanceof \SilntiBundle\Model\Prof) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID_USER, $prof->getIdUser(), $comparison);
        } elseif ($prof instanceof ObjectCollection) {
            return $this
                ->useProfQuery()
                ->filterByPrimaryKeys($prof->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProf() only accepts arguments of type \SilntiBundle\Model\Prof or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Prof relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinProf($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Prof');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Prof');
        }

        return $this;
    }

    /**
     * Use the Prof relation Prof object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SilntiBundle\Model\ProfQuery A secondary query class using the current class as primary query
     */
    public function useProfQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProf($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Prof', '\SilntiBundle\Model\ProfQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUser $user Object to remove from the list of results
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function prune($user = null)
    {
        if ($user) {
            $this->addUsingAlias(UserTableMap::COL_ID_USER, $user->getIdUser(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserTableMap::clearInstancePool();
            UserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserQuery
