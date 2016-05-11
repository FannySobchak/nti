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
use SilntiBundle\Model\Cours as ChildCours;
use SilntiBundle\Model\CoursQuery as ChildCoursQuery;
use SilntiBundle\Model\Map\CoursTableMap;

/**
 * Base class that represents a query for the 'cours' table.
 *
 *
 *
 * @method     ChildCoursQuery orderByIdCours($order = Criteria::ASC) Order by the id_cours column
 * @method     ChildCoursQuery orderByLibelle($order = Criteria::ASC) Order by the libelle column
 *
 * @method     ChildCoursQuery groupByIdCours() Group by the id_cours column
 * @method     ChildCoursQuery groupByLibelle() Group by the libelle column
 *
 * @method     ChildCoursQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCoursQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCoursQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCoursQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCoursQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCoursQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCoursQuery leftJoinEnseigner($relationAlias = null) Adds a LEFT JOIN clause to the query using the Enseigner relation
 * @method     ChildCoursQuery rightJoinEnseigner($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Enseigner relation
 * @method     ChildCoursQuery innerJoinEnseigner($relationAlias = null) Adds a INNER JOIN clause to the query using the Enseigner relation
 *
 * @method     ChildCoursQuery joinWithEnseigner($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Enseigner relation
 *
 * @method     ChildCoursQuery leftJoinWithEnseigner() Adds a LEFT JOIN clause and with to the query using the Enseigner relation
 * @method     ChildCoursQuery rightJoinWithEnseigner() Adds a RIGHT JOIN clause and with to the query using the Enseigner relation
 * @method     ChildCoursQuery innerJoinWithEnseigner() Adds a INNER JOIN clause and with to the query using the Enseigner relation
 *
 * @method     ChildCoursQuery leftJoinEpreuve($relationAlias = null) Adds a LEFT JOIN clause to the query using the Epreuve relation
 * @method     ChildCoursQuery rightJoinEpreuve($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Epreuve relation
 * @method     ChildCoursQuery innerJoinEpreuve($relationAlias = null) Adds a INNER JOIN clause to the query using the Epreuve relation
 *
 * @method     ChildCoursQuery joinWithEpreuve($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Epreuve relation
 *
 * @method     ChildCoursQuery leftJoinWithEpreuve() Adds a LEFT JOIN clause and with to the query using the Epreuve relation
 * @method     ChildCoursQuery rightJoinWithEpreuve() Adds a RIGHT JOIN clause and with to the query using the Epreuve relation
 * @method     ChildCoursQuery innerJoinWithEpreuve() Adds a INNER JOIN clause and with to the query using the Epreuve relation
 *
 * @method     ChildCoursQuery leftJoinFichier($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fichier relation
 * @method     ChildCoursQuery rightJoinFichier($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fichier relation
 * @method     ChildCoursQuery innerJoinFichier($relationAlias = null) Adds a INNER JOIN clause to the query using the Fichier relation
 *
 * @method     ChildCoursQuery joinWithFichier($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Fichier relation
 *
 * @method     ChildCoursQuery leftJoinWithFichier() Adds a LEFT JOIN clause and with to the query using the Fichier relation
 * @method     ChildCoursQuery rightJoinWithFichier() Adds a RIGHT JOIN clause and with to the query using the Fichier relation
 * @method     ChildCoursQuery innerJoinWithFichier() Adds a INNER JOIN clause and with to the query using the Fichier relation
 *
 * @method     \SilntiBundle\Model\EnseignerQuery|\SilntiBundle\Model\EpreuveQuery|\SilntiBundle\Model\FichierQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCours findOne(ConnectionInterface $con = null) Return the first ChildCours matching the query
 * @method     ChildCours findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCours matching the query, or a new ChildCours object populated from the query conditions when no match is found
 *
 * @method     ChildCours findOneByIdCours(int $id_cours) Return the first ChildCours filtered by the id_cours column
 * @method     ChildCours findOneByLibelle(string $libelle) Return the first ChildCours filtered by the libelle column *

 * @method     ChildCours requirePk($key, ConnectionInterface $con = null) Return the ChildCours by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCours requireOne(ConnectionInterface $con = null) Return the first ChildCours matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCours requireOneByIdCours(int $id_cours) Return the first ChildCours filtered by the id_cours column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCours requireOneByLibelle(string $libelle) Return the first ChildCours filtered by the libelle column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCours[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCours objects based on current ModelCriteria
 * @method     ChildCours[]|ObjectCollection findByIdCours(int $id_cours) Return ChildCours objects filtered by the id_cours column
 * @method     ChildCours[]|ObjectCollection findByLibelle(string $libelle) Return ChildCours objects filtered by the libelle column
 * @method     ChildCours[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CoursQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \SilntiBundle\Model\Base\CoursQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SilntiBundle\\Model\\Cours', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCoursQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCoursQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCoursQuery) {
            return $criteria;
        }
        $query = new ChildCoursQuery();
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
     * @return ChildCours|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CoursTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CoursTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCours A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_cours, libelle FROM cours WHERE id_cours = :p0';
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
            /** @var ChildCours $obj */
            $obj = new ChildCours();
            $obj->hydrate($row);
            CoursTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCours|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCoursQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CoursTableMap::COL_ID_COURS, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCoursQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CoursTableMap::COL_ID_COURS, $keys, Criteria::IN);
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
     * @param     mixed $idCours The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCoursQuery The current query, for fluid interface
     */
    public function filterByIdCours($idCours = null, $comparison = null)
    {
        if (is_array($idCours)) {
            $useMinMax = false;
            if (isset($idCours['min'])) {
                $this->addUsingAlias(CoursTableMap::COL_ID_COURS, $idCours['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCours['max'])) {
                $this->addUsingAlias(CoursTableMap::COL_ID_COURS, $idCours['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CoursTableMap::COL_ID_COURS, $idCours, $comparison);
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
     * @return $this|ChildCoursQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CoursTableMap::COL_LIBELLE, $libelle, $comparison);
    }

    /**
     * Filter the query by a related \SilntiBundle\Model\Enseigner object
     *
     * @param \SilntiBundle\Model\Enseigner|ObjectCollection $enseigner the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCoursQuery The current query, for fluid interface
     */
    public function filterByEnseigner($enseigner, $comparison = null)
    {
        if ($enseigner instanceof \SilntiBundle\Model\Enseigner) {
            return $this
                ->addUsingAlias(CoursTableMap::COL_ID_COURS, $enseigner->getIdCours(), $comparison);
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
     * @return $this|ChildCoursQuery The current query, for fluid interface
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
     * Filter the query by a related \SilntiBundle\Model\Epreuve object
     *
     * @param \SilntiBundle\Model\Epreuve|ObjectCollection $epreuve the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCoursQuery The current query, for fluid interface
     */
    public function filterByEpreuve($epreuve, $comparison = null)
    {
        if ($epreuve instanceof \SilntiBundle\Model\Epreuve) {
            return $this
                ->addUsingAlias(CoursTableMap::COL_ID_COURS, $epreuve->getIdCours(), $comparison);
        } elseif ($epreuve instanceof ObjectCollection) {
            return $this
                ->useEpreuveQuery()
                ->filterByPrimaryKeys($epreuve->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEpreuve() only accepts arguments of type \SilntiBundle\Model\Epreuve or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Epreuve relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCoursQuery The current query, for fluid interface
     */
    public function joinEpreuve($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Epreuve');

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
            $this->addJoinObject($join, 'Epreuve');
        }

        return $this;
    }

    /**
     * Use the Epreuve relation Epreuve object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SilntiBundle\Model\EpreuveQuery A secondary query class using the current class as primary query
     */
    public function useEpreuveQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEpreuve($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Epreuve', '\SilntiBundle\Model\EpreuveQuery');
    }

    /**
     * Filter the query by a related \SilntiBundle\Model\Fichier object
     *
     * @param \SilntiBundle\Model\Fichier|ObjectCollection $fichier the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCoursQuery The current query, for fluid interface
     */
    public function filterByFichier($fichier, $comparison = null)
    {
        if ($fichier instanceof \SilntiBundle\Model\Fichier) {
            return $this
                ->addUsingAlias(CoursTableMap::COL_ID_COURS, $fichier->getIdCours(), $comparison);
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
     * @return $this|ChildCoursQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildCours $cours Object to remove from the list of results
     *
     * @return $this|ChildCoursQuery The current query, for fluid interface
     */
    public function prune($cours = null)
    {
        if ($cours) {
            $this->addUsingAlias(CoursTableMap::COL_ID_COURS, $cours->getIdCours(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the cours table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CoursTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CoursTableMap::clearInstancePool();
            CoursTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CoursTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CoursTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CoursTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CoursTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CoursQuery
