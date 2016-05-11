<?php

namespace SilntiBundle\Model\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use SilntiBundle\Model\Cours;
use SilntiBundle\Model\CoursQuery;


/**
 * This class defines the structure of the 'cours' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CoursTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.SilntiBundle.Model.Map.CoursTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'cours';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\SilntiBundle\\Model\\Cours';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'src.SilntiBundle.Model.Cours';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 2;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 2;

    /**
     * the column name for the id_cours field
     */
    const COL_ID_COURS = 'cours.id_cours';

    /**
     * the column name for the libelle field
     */
    const COL_LIBELLE = 'cours.libelle';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('IdCours', 'Libelle', ),
        self::TYPE_CAMELNAME     => array('idCours', 'libelle', ),
        self::TYPE_COLNAME       => array(CoursTableMap::COL_ID_COURS, CoursTableMap::COL_LIBELLE, ),
        self::TYPE_FIELDNAME     => array('id_cours', 'libelle', ),
        self::TYPE_NUM           => array(0, 1, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('IdCours' => 0, 'Libelle' => 1, ),
        self::TYPE_CAMELNAME     => array('idCours' => 0, 'libelle' => 1, ),
        self::TYPE_COLNAME       => array(CoursTableMap::COL_ID_COURS => 0, CoursTableMap::COL_LIBELLE => 1, ),
        self::TYPE_FIELDNAME     => array('id_cours' => 0, 'libelle' => 1, ),
        self::TYPE_NUM           => array(0, 1, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('cours');
        $this->setPhpName('Cours');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SilntiBundle\\Model\\Cours');
        $this->setPackage('src.SilntiBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_cours', 'IdCours', 'INTEGER', true, null, null);
        $this->addColumn('libelle', 'Libelle', 'VARCHAR', true, 25, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Enseigner', '\\SilntiBundle\\Model\\Enseigner', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_cours',
    1 => ':id_cours',
  ),
), null, null, 'Enseigners', false);
        $this->addRelation('Epreuve', '\\SilntiBundle\\Model\\Epreuve', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_cours',
    1 => ':id_cours',
  ),
), null, null, 'Epreuves', false);
        $this->addRelation('Fichier', '\\SilntiBundle\\Model\\Fichier', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_cours',
    1 => ':id_cours',
  ),
), null, null, 'Fichiers', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCours', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCours', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCours', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCours', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCours', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCours', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdCours', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? CoursTableMap::CLASS_DEFAULT : CoursTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Cours object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CoursTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CoursTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CoursTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CoursTableMap::OM_CLASS;
            /** @var Cours $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CoursTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = CoursTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CoursTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Cours $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CoursTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(CoursTableMap::COL_ID_COURS);
            $criteria->addSelectColumn(CoursTableMap::COL_LIBELLE);
        } else {
            $criteria->addSelectColumn($alias . '.id_cours');
            $criteria->addSelectColumn($alias . '.libelle');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(CoursTableMap::DATABASE_NAME)->getTable(CoursTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CoursTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CoursTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CoursTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Cours or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Cours object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CoursTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SilntiBundle\Model\Cours) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CoursTableMap::DATABASE_NAME);
            $criteria->add(CoursTableMap::COL_ID_COURS, (array) $values, Criteria::IN);
        }

        $query = CoursQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CoursTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CoursTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the cours table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CoursQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Cours or Criteria object.
     *
     * @param mixed               $criteria Criteria or Cours object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CoursTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Cours object
        }

        if ($criteria->containsKey(CoursTableMap::COL_ID_COURS) && $criteria->keyContainsValue(CoursTableMap::COL_ID_COURS) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CoursTableMap::COL_ID_COURS.')');
        }


        // Set the correct dbName
        $query = CoursQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CoursTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CoursTableMap::buildTableMap();
