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
use SilntiBundle\Model\Session as ChildSession;
use SilntiBundle\Model\SessionQuery as ChildSessionQuery;
use SilntiBundle\Model\Map\SessionTableMap;

/**
 * Base class that represents a query for the 'session' table.
 *
 *
 *
 * @method     ChildSessionQuery orderByIdSession($order = Criteria::ASC) Order by the id_session column
 * @method     ChildSessionQuery orderByLibelle($order = Criteria::ASC) Order by the libelle column
 * @method     ChildSessionQuery orderByDateInscription($order = Criteria::ASC) Order by the date_inscription column
 *
 * @method     ChildSessionQuery groupByIdSession() Group by the id_session column
 * @method     ChildSessionQuery groupByLibelle() Group by the libelle column
 * @method     ChildSessionQuery groupByDateInscription() Group by the date_inscription column
 *
 * @method     ChildSessionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSessionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSessionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSessionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSessionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSessionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSessionQuery leftJoinEtudiant($relationAlias = null) Adds a LEFT JOIN clause to the query using the Etudiant relation
 * @method     ChildSessionQuery rightJoinEtudiant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Etudiant relation
 * @method     ChildSessionQuery innerJoinEtudiant($relationAlias = null) Adds a INNER JOIN clause to the query using the Etudiant relation
 *
 * @method     ChildSessionQuery joinWithEtudiant($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Etudiant relation
 *
 * @method     ChildSessionQuery leftJoinWithEtudiant() Adds a LEFT JOIN clause and with to the query using the Etudiant relation
 * @method     ChildSessionQuery rightJoinWithEtudiant() Adds a RIGHT JOIN clause and with to the query using the Etudiant relation
 * @method     ChildSessionQuery innerJoinWithEtudiant() Adds a INNER JOIN clause and with to the query using the Etudiant relation
 *
 * @method     ChildSessionQuery leftJoinNote($relationAlias = null) Adds a LEFT JOIN clause to the query using the Note relation
 * @method     ChildSessionQuery rightJoinNote($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Note relation
 * @method     ChildSessionQuery innerJoinNote($relationAlias = null) Adds a INNER JOIN clause to the query using the Note relation
 *
 * @method     ChildSessionQuery joinWithNote($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Note relation
 *
 * @method     ChildSessionQuery leftJoinWithNote() Adds a LEFT JOIN clause and with to the query using the Note relation
 * @method     ChildSessionQuery rightJoinWithNote() Adds a RIGHT JOIN clause and with to the query using the Note relation
 * @method     ChildSessionQuery innerJoinWithNote() Adds a INNER JOIN clause and with to the query using the Note relation
 *
 * @method     \SilntiBundle\Model\EtudiantQuery|\SilntiBundle\Model\NoteQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSession findOne(ConnectionInterface $con = null) Return the first ChildSession matching the query
 * @method     ChildSession findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSession matching the query, or a new ChildSession object populated from the query conditions when no match is found
 *
 * @method     ChildSession findOneByIdSession(int $id_session) Return the first ChildSession filtered by the id_session column
 * @method     ChildSession findOneByLibelle(string $libelle) Return the first ChildSession filtered by the libelle column
 * @method     ChildSession findOneByDateInscription(string $date_inscription) Return the first ChildSession filtered by the date_inscription column *

 * @method     ChildSession requirePk($key, ConnectionInterface $con = null) Return the ChildSession by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSession requireOne(ConnectionInterface $con = null) Return the first ChildSession matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSession requireOneByIdSession(int $id_session) Return the first ChildSession filtered by the id_session column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSession requireOneByLibelle(string $libelle) Return the first ChildSession filtered by the libelle column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSession requireOneByDateInscription(string $date_inscription) Return the first ChildSession filtered by the date_inscription column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSession[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSession objects based on current ModelCriteria
 * @method     ChildSession[]|ObjectCollection findByIdSession(int $id_session) Return ChildSession objects filtered by the id_session column
 * @method     ChildSession[]|ObjectCollection findByLibelle(string $libelle) Return ChildSession objects filtered by the libelle column
 * @method     ChildSession[]|ObjectCollection findByDateInscription(string $date_inscription) Return ChildSession objects filtered by the date_inscription column
 * @method     ChildSession[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SessionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \SilntiBundle\Model\Base\SessionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SilntiBundle\\Model\\Session', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSessionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSessionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSessionQuery) {
            return $criteria;
        }
        $query = new ChildSessionQuery();
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
     * @return ChildSession|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SessionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SessionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSession A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_session, libelle, date_inscription FROM session WHERE id_session = :p0';
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
            /** @var ChildSession $obj */
            $obj = new ChildSession();
            $obj->hydrate($row);
            SessionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSession|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSessionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SessionTableMap::COL_ID_SESSION, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSessionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SessionTableMap::COL_ID_SESSION, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id_session column
     *
     * Example usage:
     * <code>
     * $query->filterByIdSession(1234); // WHERE id_session = 1234
     * $query->filterByIdSession(array(12, 34)); // WHERE id_session IN (12, 34)
     * $query->filterByIdSession(array('min' => 12)); // WHERE id_session > 12
     * </code>
     *
     * @param     mixed $idSession The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionQuery The current query, for fluid interface
     */
    public function filterByIdSession($idSession = null, $comparison = null)
    {
        if (is_array($idSession)) {
            $useMinMax = false;
            if (isset($idSession['min'])) {
                $this->addUsingAlias(SessionTableMap::COL_ID_SESSION, $idSession['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSession['max'])) {
                $this->addUsingAlias(SessionTableMap::COL_ID_SESSION, $idSession['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionTableMap::COL_ID_SESSION, $idSession, $comparison);
    }

    /**
     * Filter the query on the libelle column
     *
     * Example usage:
     * <code>
     * $query->filterByLibelle('fooValue');   // WHERE libelle = 'fooValue'
     * $query->filterByLibelle('%fooValue%'); // WHERE libelle LIKE '%fooValue%'
     * </code>
     *
     * @param     string $libelle The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionQuery The current query, for fluid interface
     */
    public function filterByLibelle($libelle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($libelle)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $libelle)) {
                $libelle = str_replace('*', '%', $libelle);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SessionTableMap::COL_LIBELLE, $libelle, $comparison);
    }

    /**
     * Filter the query on the date_inscription column
     *
     * Example usage:
     * <code>
     * $query->filterByDateInscription('2011-03-14'); // WHERE date_inscription = '2011-03-14'
     * $query->filterByDateInscription('now'); // WHERE date_inscription = '2011-03-14'
     * $query->filterByDateInscription(array('max' => 'yesterday')); // WHERE date_inscription > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateInscription The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSessionQuery The current query, for fluid interface
     */
    public function filterByDateInscription($dateInscription = null, $comparison = null)
    {
        if (is_array($dateInscription)) {
            $useMinMax = false;
            if (isset($dateInscription['min'])) {
                $this->addUsingAlias(SessionTableMap::COL_DATE_INSCRIPTION, $dateInscription['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateInscription['max'])) {
                $this->addUsingAlias(SessionTableMap::COL_DATE_INSCRIPTION, $dateInscription['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SessionTableMap::COL_DATE_INSCRIPTION, $dateInscription, $comparison);
    }

    /**
     * Filter the query by a related \SilntiBundle\Model\Etudiant object
     *
     * @param \SilntiBundle\Model\Etudiant|ObjectCollection $etudiant the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSessionQuery The current query, for fluid interface
     */
    public function filterByEtudiant($etudiant, $comparison = null)
    {
        if ($etudiant instanceof \SilntiBundle\Model\Etudiant) {
            return $this
                ->addUsingAlias(SessionTableMap::COL_ID_SESSION, $etudiant->getIdSession(), $comparison);
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
     * @return $this|ChildSessionQuery The current query, for fluid interface
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
     * Filter the query by a related \SilntiBundle\Model\Note object
     *
     * @param \SilntiBundle\Model\Note|ObjectCollection $note the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSessionQuery The current query, for fluid interface
     */
    public function filterByNote($note, $comparison = null)
    {
        if ($note instanceof \SilntiBundle\Model\Note) {
            return $this
                ->addUsingAlias(SessionTableMap::COL_ID_SESSION, $note->getIdSession(), $comparison);
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
     * @return $this|ChildSessionQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildSession $session Object to remove from the list of results
     *
     * @return $this|ChildSessionQuery The current query, for fluid interface
     */
    public function prune($session = null)
    {
        if ($session) {
            $this->addUsingAlias(SessionTableMap::COL_ID_SESSION, $session->getIdSession(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the session table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SessionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SessionTableMap::clearInstancePool();
            SessionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SessionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SessionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SessionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SessionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SessionQuery
