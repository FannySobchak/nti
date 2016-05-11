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
use SilntiBundle\Model\Note;
use SilntiBundle\Model\NoteQuery;


/**
 * This class defines the structure of the 'note' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class NoteTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.SilntiBundle.Model.Map.NoteTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'note';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\SilntiBundle\\Model\\Note';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'src.SilntiBundle.Model.Note';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id_note field
     */
    const COL_ID_NOTE = 'note.id_note';

    /**
     * the column name for the note field
     */
    const COL_NOTE = 'note.note';

    /**
     * the column name for the id_epreuve field
     */
    const COL_ID_EPREUVE = 'note.id_epreuve';

    /**
     * the column name for the id_session field
     */
    const COL_ID_SESSION = 'note.id_session';

    /**
     * the column name for the id_user field
     */
    const COL_ID_USER = 'note.id_user';

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
        self::TYPE_PHPNAME       => array('IdNote', 'Note', 'IdEpreuve', 'IdSession', 'IdUser', ),
        self::TYPE_CAMELNAME     => array('idNote', 'note', 'idEpreuve', 'idSession', 'idUser', ),
        self::TYPE_COLNAME       => array(NoteTableMap::COL_ID_NOTE, NoteTableMap::COL_NOTE, NoteTableMap::COL_ID_EPREUVE, NoteTableMap::COL_ID_SESSION, NoteTableMap::COL_ID_USER, ),
        self::TYPE_FIELDNAME     => array('id_note', 'note', 'id_epreuve', 'id_session', 'id_user', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('IdNote' => 0, 'Note' => 1, 'IdEpreuve' => 2, 'IdSession' => 3, 'IdUser' => 4, ),
        self::TYPE_CAMELNAME     => array('idNote' => 0, 'note' => 1, 'idEpreuve' => 2, 'idSession' => 3, 'idUser' => 4, ),
        self::TYPE_COLNAME       => array(NoteTableMap::COL_ID_NOTE => 0, NoteTableMap::COL_NOTE => 1, NoteTableMap::COL_ID_EPREUVE => 2, NoteTableMap::COL_ID_SESSION => 3, NoteTableMap::COL_ID_USER => 4, ),
        self::TYPE_FIELDNAME     => array('id_note' => 0, 'note' => 1, 'id_epreuve' => 2, 'id_session' => 3, 'id_user' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
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
        $this->setName('note');
        $this->setPhpName('Note');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SilntiBundle\\Model\\Note');
        $this->setPackage('src.SilntiBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_note', 'IdNote', 'INTEGER', true, null, null);
        $this->addColumn('note', 'Note', 'FLOAT', true, null, null);
        $this->addForeignKey('id_epreuve', 'IdEpreuve', 'INTEGER', 'epreuve', 'id_epreuve', true, null, null);
        $this->addForeignKey('id_session', 'IdSession', 'INTEGER', 'session', 'id_session', true, null, null);
        $this->addForeignKey('id_user', 'IdUser', 'INTEGER', 'user', 'id_user', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Epreuve', '\\SilntiBundle\\Model\\Epreuve', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_epreuve',
    1 => ':id_epreuve',
  ),
), null, null, null, false);
        $this->addRelation('Session', '\\SilntiBundle\\Model\\Session', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_session',
    1 => ':id_session',
  ),
), null, null, null, false);
        $this->addRelation('User', '\\SilntiBundle\\Model\\User', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_user',
    1 => ':id_user',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNote', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNote', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNote', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNote', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNote', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNote', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdNote', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? NoteTableMap::CLASS_DEFAULT : NoteTableMap::OM_CLASS;
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
     * @return array           (Note object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = NoteTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = NoteTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + NoteTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = NoteTableMap::OM_CLASS;
            /** @var Note $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            NoteTableMap::addInstanceToPool($obj, $key);
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
            $key = NoteTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = NoteTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Note $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                NoteTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(NoteTableMap::COL_ID_NOTE);
            $criteria->addSelectColumn(NoteTableMap::COL_NOTE);
            $criteria->addSelectColumn(NoteTableMap::COL_ID_EPREUVE);
            $criteria->addSelectColumn(NoteTableMap::COL_ID_SESSION);
            $criteria->addSelectColumn(NoteTableMap::COL_ID_USER);
        } else {
            $criteria->addSelectColumn($alias . '.id_note');
            $criteria->addSelectColumn($alias . '.note');
            $criteria->addSelectColumn($alias . '.id_epreuve');
            $criteria->addSelectColumn($alias . '.id_session');
            $criteria->addSelectColumn($alias . '.id_user');
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
        return Propel::getServiceContainer()->getDatabaseMap(NoteTableMap::DATABASE_NAME)->getTable(NoteTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(NoteTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(NoteTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new NoteTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Note or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Note object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(NoteTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SilntiBundle\Model\Note) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(NoteTableMap::DATABASE_NAME);
            $criteria->add(NoteTableMap::COL_ID_NOTE, (array) $values, Criteria::IN);
        }

        $query = NoteQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            NoteTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                NoteTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the note table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return NoteQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Note or Criteria object.
     *
     * @param mixed               $criteria Criteria or Note object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NoteTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Note object
        }

        if ($criteria->containsKey(NoteTableMap::COL_ID_NOTE) && $criteria->keyContainsValue(NoteTableMap::COL_ID_NOTE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.NoteTableMap::COL_ID_NOTE.')');
        }


        // Set the correct dbName
        $query = NoteQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // NoteTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
NoteTableMap::buildTableMap();
