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
use SilntiBundle\Model\Enseigner as ChildEnseigner;
use SilntiBundle\Model\EnseignerQuery as ChildEnseignerQuery;
use SilntiBundle\Model\Map\EnseignerTableMap;

/**
 * Base class that represents a query for the 'enseigner' table.
 *
 *
 *
 * @method     ChildEnseignerQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildEnseignerQuery orderByIdCours($order = Criteria::ASC) Order by the id_cours column
 *
 * @method     ChildEnseignerQuery groupByIdUser() Group by the id_user column
 * @method     ChildEnseignerQuery groupByIdCours() Group by the id_cours column
 *
 * @method     ChildEnseignerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEnseignerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEnseignerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEnseignerQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEnseignerQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEnseignerQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEnseignerQuery leftJoinCours($relationAlias = null) Adds a LEFT JOIN clause to the query using the Cours relation
 * @method     ChildEnseignerQuery rightJoinCours($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Cours relation
 * @method     ChildEnseignerQuery innerJoinCours($relationAlias = null) Adds a INNER JOIN clause to the query using the Cours relation
 *
 * @method     ChildEnseignerQuery joinWithCours($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Cours relation
 *
 * @method     ChildEnseignerQuery leftJoinWithCours() Adds a LEFT JOIN clause and with to the query using the Cours relation
 * @method     ChildEnseignerQuery rightJoinWithCours() Adds a RIGHT JOIN clause and with to the query using the Cours relation
 * @method     ChildEnseignerQuery innerJoinWithCours() Adds a INNER JOIN clause and with to the query using the Cours relation
 *
 * @method     ChildEnseignerQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildEnseignerQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildEnseignerQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildEnseignerQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildEnseignerQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildEnseignerQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildEnseignerQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     \SilntiBundle\Model\CoursQuery|\SilntiBundle\Model\UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEnseigner findOne(ConnectionInterface $con = null) Return the first ChildEnseigner matching the query
 * @method     ChildEnseigner findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEnseigner matching the query, or a new ChildEnseigner object populated from the query conditions when no match is found
 *
 * @method     ChildEnseigner findOneByIdUser(int $id_user) Return the first ChildEnseigner filtered by the id_user column
 * @method     ChildEnseigner findOneByIdCours(int $id_cours) Return the first ChildEnseigner filtered by the id_cours column *

 * @method     ChildEnseigner requirePk($key, ConnectionInterface $con = null) Return the ChildEnseigner by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnseigner requireOne(ConnectionInterface $con = null) Return the first ChildEnseigner matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEnseigner requireOneByIdUser(int $id_user) Return the first ChildEnseigner filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnseigner requireOneByIdCours(int $id_cours) Return the first ChildEnseigner filtered by the id_cours column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEnseigner[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEnseigner objects based on current ModelCriteria
 * @method     ChildEnseigner[]|ObjectCollection findByIdUser(int $id_user) Return ChildEnseigner objects filtered by the id_user column
 * @method     ChildEnseigner[]|ObjectCollection findByIdCours(int $id_cours) Return ChildEnseigner objects filtered by the id_cours column
 * @method     ChildEnseigner[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EnseignerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \SilntiBundle\Model\Base\EnseignerQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SilntiBundle\\Model\\Enseigner', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEnseignerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEnseignerQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEnseignerQuery) {
            return $criteria;
        }
        $query = new ChildEnseignerQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id_user, $id_cours] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildEnseigner|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EnseignerTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EnseignerTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildEnseigner A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_user, id_cours FROM enseigner WHERE id_user = :p0 AND id_cours = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildEnseigner $obj */
            $obj = new ChildEnseigner();
            $obj->hydrate($row);
            EnseignerTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildEnseigner|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildEnseignerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(EnseignerTableMap::COL_ID_USER, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(EnseignerTableMap::COL_ID_COURS, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEnseignerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(EnseignerTableMap::COL_ID_USER, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(EnseignerTableMap::COL_ID_COURS, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildEnseignerQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(EnseignerTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(EnseignerTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnseignerTableMap::COL_ID_USER, $idUser, $comparison);
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
     * @return $this|ChildEnseignerQuery The current query, for fluid interface
     */
    public function filterByIdCours($idCours = null, $comparison = null)
    {
        if (is_array($idCours)) {
            $useMinMax = false;
            if (isset($idCours['min'])) {
                $this->addUsingAlias(EnseignerTableMap::COL_ID_COURS, $idCours['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCours['max'])) {
                $this->addUsingAlias(EnseignerTableMap::COL_ID_COURS, $idCours['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnseignerTableMap::COL_ID_COURS, $idCours, $comparison);
    }

    /**
     * Filter the query by a related \SilntiBundle\Model\Cours object
     *
     * @param \SilntiBundle\Model\Cours|ObjectCollection $cours The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEnseignerQuery The current query, for fluid interface
     */
    public function filterByCours($cours, $comparison = null)
    {
        if ($cours instanceof \SilntiBundle\Model\Cours) {
            return $this
                ->addUsingAlias(EnseignerTableMap::COL_ID_COURS, $cours->getIdCours(), $comparison);
        } elseif ($cours instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EnseignerTableMap::COL_ID_COURS, $cours->toKeyValue('PrimaryKey', 'IdCours'), $comparison);
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
     * @return $this|ChildEnseignerQuery The current query, for fluid interface
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
     * @return ChildEnseignerQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \SilntiBundle\Model\User) {
            return $this
                ->addUsingAlias(EnseignerTableMap::COL_ID_USER, $user->getIdUser(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EnseignerTableMap::COL_ID_USER, $user->toKeyValue('PrimaryKey', 'IdUser'), $comparison);
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
     * @return $this|ChildEnseignerQuery The current query, for fluid interface
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
     * @param   ChildEnseigner $enseigner Object to remove from the list of results
     *
     * @return $this|ChildEnseignerQuery The current query, for fluid interface
     */
    public function prune($enseigner = null)
    {
        if ($enseigner) {
            $this->addCond('pruneCond0', $this->getAliasedColName(EnseignerTableMap::COL_ID_USER), $enseigner->getIdUser(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(EnseignerTableMap::COL_ID_COURS), $enseigner->getIdCours(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the enseigner table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EnseignerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EnseignerTableMap::clearInstancePool();
            EnseignerTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EnseignerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EnseignerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EnseignerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EnseignerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EnseignerQuery
