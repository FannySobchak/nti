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
use SilntiBundle\Model\Epreuve;
use SilntiBundle\Model\EpreuveQuery;


/**
 * This class defines the structure of the 'epreuve' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class EpreuveTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src\SilntiBundle.Model.Map.EpreuveTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'epreuve';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\SilntiBundle\\Model\\Epreuve';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'src\SilntiBundle.Model.Epreuve';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the id_epreuve field
     */
    const COL_ID_EPREUVE = 'epreuve.id_epreuve';

    /**
     * the column name for the dateEpreuve field
     */
    const COL_DATEEPREUVE = 'epreuve.dateEpreuve';

    /**
     * the column name for the intitule field
     */
    const COL_INTITULE = 'epreuve.intitule';

    /**
     * the column name for the id_cours field
     */
    const COL_ID_COURS = 'epreuve.id_cours';

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
        self::TYPE_PHPNAME       => array('IdEpreuve', 'Dateepreuve', 'Intitule', 'IdCours', ),
        self::TYPE_CAMELNAME     => array('idEpreuve', 'dateepreuve', 'intitule', 'idCours', ),
        self::TYPE_COLNAME       => array(EpreuveTableMap::COL_ID_EPREUVE, EpreuveTableMap::COL_DATEEPREUVE, EpreuveTableMap::COL_INTITULE, EpreuveTableMap::COL_ID_COURS, ),
        self::TYPE_FIELDNAME     => array('id_epreuve', 'dateEpreuve', 'intitule', 'id_cours', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('IdEpreuve' => 0, 'Dateepreuve' => 1, 'Intitule' => 2, 'IdCours' => 3, ),
        self::TYPE_CAMELNAME     => array('idEpreuve' => 0, 'dateepreuve' => 1, 'intitule' => 2, 'idCours' => 3, ),
        self::TYPE_COLNAME       => array(EpreuveTableMap::COL_ID_EPREUVE => 0, EpreuveTableMap::COL_DATEEPREUVE => 1, EpreuveTableMap::COL_INTITULE => 2, EpreuveTableMap::COL_ID_COURS => 3, ),
        self::TYPE_FIELDNAME     => array('id_epreuve' => 0, 'dateEpreuve' => 1, 'intitule' => 2, 'id_cours' => 3, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
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
        $this->setName('epreuve');
        $this->setPhpName('Epreuve');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SilntiBundle\\Model\\Epreuve');
        $this->setPackage('src\SilntiBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_epreuve', 'IdEpreuve', 'INTEGER', true, null, null);
        $this->addColumn('dateEpreuve', 'Dateepreuve', 'DATE', true, null, null);
        $this->addColumn('intitule', 'Intitule', 'VARCHAR', false, 25, null);
        $this->addForeignKey('id_cours', 'IdCours', 'INTEGER', 'cours', 'id_cours', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Cours', '\\SilntiBundle\\Model\\Cours', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_cours',
    1 => ':id_cours',
  ),
), null, null, null, false);
        $this->addRelation('Note', '\\SilntiBundle\\Model\\Note', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_epreuve',
    1 => ':id_epreuve',
  ),
), null, null, 'Notes', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdEpreuve', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdEpreuve', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdEpreuve', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdEpreuve', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdEpreuve', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdEpreuve', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdEpreuve', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EpreuveTableMap::CLASS_DEFAULT : EpreuveTableMap::OM_CLASS;
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
     * @return array           (Epreuve object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = EpreuveTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EpreuveTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EpreuveTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EpreuveTableMap::OM_CLASS;
            /** @var Epreuve $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EpreuveTableMap::addInstanceToPool($obj, $key);
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
            $key = EpreuveTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EpreuveTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Epreuve $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EpreuveTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EpreuveTableMap::COL_ID_EPREUVE);
            $criteria->addSelectColumn(EpreuveTableMap::COL_DATEEPREUVE);
            $criteria->addSelectColumn(EpreuveTableMap::COL_INTITULE);
            $criteria->addSelectColumn(EpreuveTableMap::COL_ID_COURS);
        } else {
            $criteria->addSelectColumn($alias . '.id_epreuve');
            $criteria->addSelectColumn($alias . '.dateEpreuve');
            $criteria->addSelectColumn($alias . '.intitule');
            $criteria->addSelectColumn($alias . '.id_cours');
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
        return Propel::getServiceContainer()->getDatabaseMap(EpreuveTableMap::DATABASE_NAME)->getTable(EpreuveTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(EpreuveTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(EpreuveTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new EpreuveTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Epreuve or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Epreuve object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EpreuveTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SilntiBundle\Model\Epreuve) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EpreuveTableMap::DATABASE_NAME);
            $criteria->add(EpreuveTableMap::COL_ID_EPREUVE, (array) $values, Criteria::IN);
        }

        $query = EpreuveQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EpreuveTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EpreuveTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the epreuve table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return EpreuveQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Epreuve or Criteria object.
     *
     * @param mixed               $criteria Criteria or Epreuve object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EpreuveTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Epreuve object
        }

        if ($criteria->containsKey(EpreuveTableMap::COL_ID_EPREUVE) && $criteria->keyContainsValue(EpreuveTableMap::COL_ID_EPREUVE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EpreuveTableMap::COL_ID_EPREUVE.')');
        }


        // Set the correct dbName
        $query = EpreuveQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // EpreuveTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
EpreuveTableMap::buildTableMap();
