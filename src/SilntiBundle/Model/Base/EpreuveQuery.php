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
use SilntiBundle\Model\Epreuve as ChildEpreuve;
use SilntiBundle\Model\EpreuveQuery as ChildEpreuveQuery;
use SilntiBundle\Model\Map\EpreuveTableMap;

/**
 * Base class that represents a query for the 'epreuve' table.
 *
 *
 *
 * @method     ChildEpreuveQuery orderByIdEpreuve($order = Criteria::ASC) Order by the id_epreuve column
 * @method     ChildEpreuveQuery orderByDateepreuve($order = Criteria::ASC) Order by the dateEpreuve column
 * @method     ChildEpreuveQuery orderByIntitule($order = Criteria::ASC) Order by the intitule column
 * @method     ChildEpreuveQuery orderByIdCours($order = Criteria::ASC) Order by the id_cours column
 *
 * @method     ChildEpreuveQuery groupByIdEpreuve() Group by the id_epreuve column
 * @method     ChildEpreuveQuery groupByDateepreuve() Group by the dateEpreuve column
 * @method     ChildEpreuveQuery groupByIntitule() Group by the intitule column
 * @method     ChildEpreuveQuery groupByIdCours() Group by the id_cours column
 *
 * @method     ChildEpreuveQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEpreuveQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEpreuveQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEpreuveQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEpreuveQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEpreuveQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEpreuveQuery leftJoinCours($relationAlias = null) Adds a LEFT JOIN clause to the query using the Cours relation
 * @method     ChildEpreuveQuery rightJoinCours($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Cours relation
 * @method     ChildEpreuveQuery innerJoinCours($relationAlias = null) Adds a INNER JOIN clause to the query using the Cours relation
 *
 * @method     ChildEpreuveQuery joinWithCours($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Cours relation
 *
 * @method     ChildEpreuveQuery leftJoinWithCours() Adds a LEFT JOIN clause and with to the query using the Cours relation
 * @method     ChildEpreuveQuery rightJoinWithCours() Adds a RIGHT JOIN clause and with to the query using the Cours relation
 * @method     ChildEpreuveQuery innerJoinWithCours() Adds a INNER JOIN clause and with to the query using the Cours relation
 *
 * @method     ChildEpreuveQuery leftJoinNote($relationAlias = null) Adds a LEFT JOIN clause to the query using the Note relation
 * @method     ChildEpreuveQuery rightJoinNote($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Note relation
 * @method     ChildEpreuveQuery innerJoinNote($relationAlias = null) Adds a INNER JOIN clause to the query using the Note relation
 *
 * @method     ChildEpreuveQuery joinWithNote($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Note relation
 *
 * @method     ChildEpreuveQuery leftJoinWithNote() Adds a LEFT JOIN clause and with to the query using the Note relation
 * @method     ChildEpreuveQuery rightJoinWithNote() Adds a RIGHT JOIN clause and with to the query using the Note relation
 * @method     ChildEpreuveQuery innerJoinWithNote() Adds a INNER JOIN clause and with to the query using the Note relation
 *
 * @method     \SilntiBundle\Model\CoursQuery|\SilntiBundle\Model\NoteQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEpreuve findOne(ConnectionInterface $con = null) Return the first ChildEpreuve matching the query
 * @method     ChildEpreuve findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEpreuve matching the query, or a new ChildEpreuve object populated from the query conditions when no match is found
 *
 * @method     ChildEpreuve findOneByIdEpreuve(int $id_epreuve) Return the first ChildEpreuve filtered by the id_epreuve column
 * @method     ChildEpreuve findOneByDateepreuve(string $dateEpreuve) Return the first ChildEpreuve filtered by the dateEpreuve column
 * @method     ChildEpreuve findOneByIntitule(string $intitule) Return the first ChildEpreuve filtered by the intitule column
 * @method     ChildEpreuve findOneByIdCours(int $id_cours) Return the first ChildEpreuve filtered by the id_cours column *

 * @method     ChildEpreuve requirePk($key, ConnectionInterface $con = null) Return the ChildEpreuve by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEpreuve requireOne(ConnectionInterface $con = null) Return the first ChildEpreuve matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEpreuve requireOneByIdEpreuve(int $id_epreuve) Return the first ChildEpreuve filtered by the id_epreuve column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEpreuve requireOneByDateepreuve(string $dateEpreuve) Return the first ChildEpreuve filtered by the dateEpreuve column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEpreuve requireOneByIntitule(string $intitule) Return the first ChildEpreuve filtered by the intitule column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEpreuve requireOneByIdCours(int $id_cours) Return the first ChildEpreuve filtered by the id_cours column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEpreuve[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEpreuve objects based on current ModelCriteria
 * @method     ChildEpreuve[]|ObjectCollection findByIdEpreuve(int $id_epreuve) Return ChildEpreuve objects filtered by the id_epreuve column
 * @method     ChildEpreuve[]|ObjectCollection findByDateepreuve(string $dateEpreuve) Return ChildEpreuve objects filtered by the dateEpreuve column
 * @method     ChildEpreuve[]|ObjectCollection findByIntitule(string $intitule) Return ChildEpreuve objects filtered by the intitule column
 * @method     ChildEpreuve[]|ObjectCollection findByIdCours(int $id_cours) Return ChildEpreuve objects filtered by the id_cours column
 * @method     ChildEpreuve[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EpreuveQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \SilntiBundle\Model\Base\EpreuveQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SilntiBundle\\Model\\Epreuve', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEpreuveQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEpreuveQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEpreuveQuery) {
            return $criteria;
        }
        $query = new ChildEpreuveQuery();
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
     * @return ChildEpreuve|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EpreuveTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EpreuveTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEpreuve A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_epreuve, dateEpreuve, intitule, id_cours FROM epreuve WHERE id_epreuve = :p0';
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
            /** @var ChildEpreuve $obj */
            $obj = new ChildEpreuve();
            $obj->hydrate($row);
            EpreuveTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEpreuve|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEpreuveQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EpreuveTableMap::COL_ID_EPREUVE, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEpreuveQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EpreuveTableMap::COL_ID_EPREUVE, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id_epreuve column
     *
     * Example usage:
     * <code>
     * $query->filterByIdEpreuve(1234); // WHERE id_epreuve = 1234
     * $query->filterByIdEpreuve(array(12, 34)); // WHERE id_epreuve IN (12, 34)
     * $query->filterByIdEpreuve(array('min' => 12)); // WHERE id_epreuve > 12
     * </code>
     *
     * @param     mixed $idEpreuve The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEpreuveQuery The current query, for fluid interface
     */
    public function filterByIdEpreuve($idEpreuve = null, $comparison = null)
    {
        if (is_array($idEpreuve)) {
            $useMinMax = false;
            if (isset($idEpreuve['min'])) {
                $this->addUsingAlias(EpreuveTableMap::COL_ID_EPREUVE, $idEpreuve['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idEpreuve['max'])) {
                $this->addUsingAlias(EpreuveTableMap::COL_ID_EPREUVE, $idEpreuve['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EpreuveTableMap::COL_ID_EPREUVE, $idEpreuve, $comparison);
    }

    /**
     * Filter the query on the dateEpreuve column
     *
     * Example usage:
     * <code>
     * $query->filterByDateepreuve('2011-03-14'); // WHERE dateEpreuve = '2011-03-14'
     * $query->filterByDateepreuve('now'); // WHERE dateEpreuve = '2011-03-14'
     * $query->filterByDateepreuve(array('max' => 'yesterday')); // WHERE dateEpreuve > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateepreuve The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEpreuveQuery The current query, for fluid interface
     */
    public function filterByDateepreuve($dateepreuve = null, $comparison = null)
    {
        if (is_array($dateepreuve)) {
            $useMinMax = false;
            if (isset($dateepreuve['min'])) {
                $this->addUsingAlias(EpreuveTableMap::COL_DATEEPREUVE, $dateepreuve['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateepreuve['max'])) {
                $this->addUsingAlias(EpreuveTableMap::COL_DATEEPREUVE, $dateepreuve['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EpreuveTableMap::COL_DATEEPREUVE, $dateepreuve, $comparison);
    }

    /**
     * Filter the query on the intitule column
     *
     * Example usage:
     * <code>
     * $query->filterByIntitule('fooValue');   // WHERE intitule = 'fooValue'
     * $query->filterByIntitule('%fooValue%'); // WHERE intitule LIKE '%fooValue%'
     * </code>
     *
     * @param     string $intitule The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEpreuveQuery The current query, for fluid interface
     */
    public function filterByIntitule($intitule = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($intitule)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $intitule)) {
                $intitule = str_replace('*', '%', $intitule);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EpreuveTableMap::COL_INTITULE, $intitule, $comparison);
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
     * @return $this|ChildEpreuveQuery The current query, for fluid interface
     */
    public function filterByIdCours($idCours = null, $comparison = null)
    {
        if (is_array($idCours)) {
            $useMinMax = false;
            if (isset($idCours['min'])) {
                $this->addUsingAlias(EpreuveTableMap::COL_ID_COURS, $idCours['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCours['max'])) {
                $this->addUsingAlias(EpreuveTableMap::COL_ID_COURS, $idCours['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EpreuveTableMap::COL_ID_COURS, $idCours, $comparison);
    }

    /**
     * Filter the query by a related \SilntiBundle\Model\Cours object
     *
     * @param \SilntiBundle\Model\Cours|ObjectCollection $cours The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEpreuveQuery The current query, for fluid interface
     */
    public function filterByCours($cours, $comparison = null)
    {
        if ($cours instanceof \SilntiBundle\Model\Cours) {
            return $this
                ->addUsingAlias(EpreuveTableMap::COL_ID_COURS, $cours->getIdCours(), $comparison);
        } elseif ($cours instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EpreuveTableMap::COL_ID_COURS, $cours->toKeyValue('PrimaryKey', 'IdCours'), $comparison);
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
     * @return $this|ChildEpreuveQuery The current query, for fluid interface
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
     * Filter the query by a related \SilntiBundle\Model\Note object
     *
     * @param \SilntiBundle\Model\Note|ObjectCollection $note the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEpreuveQuery The current query, for fluid interface
     */
    public function filterByNote($note, $comparison = null)
    {
        if ($note instanceof \SilntiBundle\Model\Note) {
            return $this
                ->addUsingAlias(EpreuveTableMap::COL_ID_EPREUVE, $note->getIdEpreuve(), $comparison);
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
     * @return $this|ChildEpreuveQuery The current query, for fluid interface
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
     * @param   ChildEpreuve $epreuve Object to remove from the list of results
     *
     * @return $this|ChildEpreuveQuery The current query, for fluid interface
     */
    public function prune($epreuve = null)
    {
        if ($epreuve) {
            $this->addUsingAlias(EpreuveTableMap::COL_ID_EPREUVE, $epreuve->getIdEpreuve(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the epreuve table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EpreuveTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EpreuveTableMap::clearInstancePool();
            EpreuveTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EpreuveTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EpreuveTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EpreuveTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EpreuveTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EpreuveQuery
