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
use SilntiBundle\Model\Fichier as ChildFichier;
use SilntiBundle\Model\FichierQuery as ChildFichierQuery;
use SilntiBundle\Model\Map\FichierTableMap;

/**
 * Base class that represents a query for the 'fichier' table.
 *
 *
 *
 * @method     ChildFichierQuery orderByIdFichier($order = Criteria::ASC) Order by the id_fichier column
 * @method     ChildFichierQuery orderByChemin($order = Criteria::ASC) Order by the chemin column
 * @method     ChildFichierQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildFichierQuery orderByIdCours($order = Criteria::ASC) Order by the id_cours column
 *
 * @method     ChildFichierQuery groupByIdFichier() Group by the id_fichier column
 * @method     ChildFichierQuery groupByChemin() Group by the chemin column
 * @method     ChildFichierQuery groupByIdUser() Group by the id_user column
 * @method     ChildFichierQuery groupByIdCours() Group by the id_cours column
 *
 * @method     ChildFichierQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFichierQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFichierQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFichierQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFichierQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFichierQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFichierQuery leftJoinCours($relationAlias = null) Adds a LEFT JOIN clause to the query using the Cours relation
 * @method     ChildFichierQuery rightJoinCours($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Cours relation
 * @method     ChildFichierQuery innerJoinCours($relationAlias = null) Adds a INNER JOIN clause to the query using the Cours relation
 *
 * @method     ChildFichierQuery joinWithCours($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Cours relation
 *
 * @method     ChildFichierQuery leftJoinWithCours() Adds a LEFT JOIN clause and with to the query using the Cours relation
 * @method     ChildFichierQuery rightJoinWithCours() Adds a RIGHT JOIN clause and with to the query using the Cours relation
 * @method     ChildFichierQuery innerJoinWithCours() Adds a INNER JOIN clause and with to the query using the Cours relation
 *
 * @method     ChildFichierQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildFichierQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildFichierQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildFichierQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildFichierQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildFichierQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildFichierQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     \SilntiBundle\Model\CoursQuery|\SilntiBundle\Model\UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFichier findOne(ConnectionInterface $con = null) Return the first ChildFichier matching the query
 * @method     ChildFichier findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFichier matching the query, or a new ChildFichier object populated from the query conditions when no match is found
 *
 * @method     ChildFichier findOneByIdFichier(int $id_fichier) Return the first ChildFichier filtered by the id_fichier column
 * @method     ChildFichier findOneByChemin(string $chemin) Return the first ChildFichier filtered by the chemin column
 * @method     ChildFichier findOneByIdUser(int $id_user) Return the first ChildFichier filtered by the id_user column
 * @method     ChildFichier findOneByIdCours(int $id_cours) Return the first ChildFichier filtered by the id_cours column *

 * @method     ChildFichier requirePk($key, ConnectionInterface $con = null) Return the ChildFichier by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFichier requireOne(ConnectionInterface $con = null) Return the first ChildFichier matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFichier requireOneByIdFichier(int $id_fichier) Return the first ChildFichier filtered by the id_fichier column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFichier requireOneByChemin(string $chemin) Return the first ChildFichier filtered by the chemin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFichier requireOneByIdUser(int $id_user) Return the first ChildFichier filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFichier requireOneByIdCours(int $id_cours) Return the first ChildFichier filtered by the id_cours column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFichier[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFichier objects based on current ModelCriteria
 * @method     ChildFichier[]|ObjectCollection findByIdFichier(int $id_fichier) Return ChildFichier objects filtered by the id_fichier column
 * @method     ChildFichier[]|ObjectCollection findByChemin(string $chemin) Return ChildFichier objects filtered by the chemin column
 * @method     ChildFichier[]|ObjectCollection findByIdUser(int $id_user) Return ChildFichier objects filtered by the id_user column
 * @method     ChildFichier[]|ObjectCollection findByIdCours(int $id_cours) Return ChildFichier objects filtered by the id_cours column
 * @method     ChildFichier[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FichierQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \SilntiBundle\Model\Base\FichierQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SilntiBundle\\Model\\Fichier', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFichierQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFichierQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFichierQuery) {
            return $criteria;
        }
        $query = new ChildFichierQuery();
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
     * @return ChildFichier|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FichierTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FichierTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFichier A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_fichier, chemin, id_user, id_cours FROM fichier WHERE id_fichier = :p0';
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
            /** @var ChildFichier $obj */
            $obj = new ChildFichier();
            $obj->hydrate($row);
            FichierTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFichier|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFichierQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FichierTableMap::COL_ID_FICHIER, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFichierQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FichierTableMap::COL_ID_FICHIER, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id_fichier column
     *
     * Example usage:
     * <code>
     * $query->filterByIdFichier(1234); // WHERE id_fichier = 1234
     * $query->filterByIdFichier(array(12, 34)); // WHERE id_fichier IN (12, 34)
     * $query->filterByIdFichier(array('min' => 12)); // WHERE id_fichier > 12
     * </code>
     *
     * @param     mixed $idFichier The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFichierQuery The current query, for fluid interface
     */
    public function filterByIdFichier($idFichier = null, $comparison = null)
    {
        if (is_array($idFichier)) {
            $useMinMax = false;
            if (isset($idFichier['min'])) {
                $this->addUsingAlias(FichierTableMap::COL_ID_FICHIER, $idFichier['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idFichier['max'])) {
                $this->addUsingAlias(FichierTableMap::COL_ID_FICHIER, $idFichier['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FichierTableMap::COL_ID_FICHIER, $idFichier, $comparison);
    }

    /**
     * Filter the query on the chemin column
     *
     * Example usage:
     * <code>
     * $query->filterByChemin('fooValue');   // WHERE chemin = 'fooValue'
     * $query->filterByChemin('%fooValue%'); // WHERE chemin LIKE '%fooValue%'
     * </code>
     *
     * @param     string $chemin The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFichierQuery The current query, for fluid interface
     */
    public function filterByChemin($chemin = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($chemin)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $chemin)) {
                $chemin = str_replace('*', '%', $chemin);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FichierTableMap::COL_CHEMIN, $chemin, $comparison);
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
     * @see       filterByUser()
     *
     * @param     mixed $idUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFichierQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(FichierTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(FichierTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FichierTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the id_cours column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCours(1234); // WHERE id_cours = 1234
     * $query->filterByIdCours(array(12, 34)); // WHERE id_cours IN (12, 34)
     * $query->filterByIdCours(array('min' => 12)); // WHERE id_cours > 12
     * </code>
     *
     * @see       filterByCours()
     *
     * @param     mixed $idCours The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFichierQuery The current query, for fluid interface
     */
    public function filterByIdCours($idCours = null, $comparison = null)
    {
        if (is_array($idCours)) {
            $useMinMax = false;
            if (isset($idCours['min'])) {
                $this->addUsingAlias(FichierTableMap::COL_ID_COURS, $idCours['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCours['max'])) {
                $this->addUsingAlias(FichierTableMap::COL_ID_COURS, $idCours['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FichierTableMap::COL_ID_COURS, $idCours, $comparison);
    }

    /**
     * Filter the query by a related \SilntiBundle\Model\Cours object
     *
     * @param \SilntiBundle\Model\Cours|ObjectCollection $cours The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFichierQuery The current query, for fluid interface
     */
    public function filterByCours($cours, $comparison = null)
    {
        if ($cours instanceof \SilntiBundle\Model\Cours) {
            return $this
                ->addUsingAlias(FichierTableMap::COL_ID_COURS, $cours->getIdCours(), $comparison);
        } elseif ($cours instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FichierTableMap::COL_ID_COURS, $cours->toKeyValue('PrimaryKey', 'IdCours'), $comparison);
        } else {
            throw new PropelException('filterByCours() only accepts arguments of type \SilntiBundle\Model\Cours or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Cours relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFichierQuery The current query, for fluid interface
     */
    public function joinCours($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Cours');

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
            $this->addJoinObject($join, 'Cours');
        }

        return $this;
    }

    /**
     * Use the Cours relation Cours object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SilntiBundle\Model\CoursQuery A secondary query class using the current class as primary query
     */
    public function useCoursQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCours($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Cours', '\SilntiBundle\Model\CoursQuery');
    }

    /**
     * Filter the query by a related \SilntiBundle\Model\User object
     *
     * @param \SilntiBundle\Model\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFichierQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \SilntiBundle\Model\User) {
            return $this
                ->addUsingAlias(FichierTableMap::COL_ID_USER, $user->getIdUser(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FichierTableMap::COL_ID_USER, $user->toKeyValue('PrimaryKey', 'IdUser'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \SilntiBundle\Model\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFichierQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SilntiBundle\Model\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\SilntiBundle\Model\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFichier $fichier Object to remove from the list of results
     *
     * @return $this|ChildFichierQuery The current query, for fluid interface
     */
    public function prune($fichier = null)
    {
        if ($fichier) {
            $this->addUsingAlias(FichierTableMap::COL_ID_FICHIER, $fichier->getIdFichier(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the fichier table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FichierTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FichierTableMap::clearInstancePool();
            FichierTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FichierTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FichierTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FichierTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FichierTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FichierQuery
