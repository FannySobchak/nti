<?php

namespace SilntiBundle\Model\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use SilntiBundle\Model\Cours as ChildCours;
use SilntiBundle\Model\CoursQuery as ChildCoursQuery;
use SilntiBundle\Model\Enseigner as ChildEnseigner;
use SilntiBundle\Model\EnseignerQuery as ChildEnseignerQuery;
use SilntiBundle\Model\Epreuve as ChildEpreuve;
use SilntiBundle\Model\EpreuveQuery as ChildEpreuveQuery;
use SilntiBundle\Model\Fichier as ChildFichier;
use SilntiBundle\Model\FichierQuery as ChildFichierQuery;
use SilntiBundle\Model\Map\CoursTableMap;
use SilntiBundle\Model\Map\EnseignerTableMap;
use SilntiBundle\Model\Map\EpreuveTableMap;
use SilntiBundle\Model\Map\FichierTableMap;

/**
 * Base class that represents a row from the 'cours' table.
 *
 *
 *
* @package    propel.generator.src\SilntiBundle.Model.Base
*/
abstract class Cours implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\SilntiBundle\\Model\\Map\\CoursTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id_cours field.
     *
     * @var        int
     */
    protected $id_cours;

    /**
     * The value for the libelle field.
     *
     * @var        string
     */
    protected $libelle;

    /**
     * @var        ObjectCollection|ChildEnseigner[] Collection to store aggregation of ChildEnseigner objects.
     */
    protected $collEnseigners;
    protected $collEnseignersPartial;

    /**
     * @var        ObjectCollection|ChildEpreuve[] Collection to store aggregation of ChildEpreuve objects.
     */
    protected $collEpreuves;
    protected $collEpreuvesPartial;

    /**
     * @var        ObjectCollection|ChildFichier[] Collection to store aggregation of ChildFichier objects.
     */
    protected $collFichiers;
    protected $collFichiersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEnseigner[]
     */
    protected $enseignersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEpreuve[]
     */
    protected $epreuvesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFichier[]
     */
    protected $fichiersScheduledForDeletion = null;

    /**
     * Initializes internal state of SilntiBundle\Model\Base\Cours object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Cours</code> instance.  If
     * <code>obj</code> is an instance of <code>Cours</code>, delegates to
     * <code>equals(Cours)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Cours The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id_cours] column value.
     *
     * @return int
     */
    public function getIdCours()
    {
        return $this->id_cours;
    }

    /**
     * Get the [libelle] column value.
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set the value of [id_cours] column.
     *
     * @param int $v new value
     * @return $this|\SilntiBundle\Model\Cours The current object (for fluent API support)
     */
    public function setIdCours($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_cours !== $v) {
            $this->id_cours = $v;
            $this->modifiedColumns[CoursTableMap::COL_ID_COURS] = true;
        }

        return $this;
    } // setIdCours()

    /**
     * Set the value of [libelle] column.
     *
     * @param string $v new value
     * @return $this|\SilntiBundle\Model\Cours The current object (for fluent API support)
     */
    public function setLibelle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->libelle !== $v) {
            $this->libelle = $v;
            $this->modifiedColumns[CoursTableMap::COL_LIBELLE] = true;
        }

        return $this;
    } // setLibelle()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CoursTableMap::translateFieldName('IdCours', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_cours = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CoursTableMap::translateFieldName('Libelle', TableMap::TYPE_PHPNAME, $indexType)];
            $this->libelle = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 2; // 2 = CoursTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\SilntiBundle\\Model\\Cours'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CoursTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCoursQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collEnseigners = null;

            $this->collEpreuves = null;

            $this->collFichiers = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Cours::setDeleted()
     * @see Cours::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CoursTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCoursQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CoursTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                CoursTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->enseignersScheduledForDeletion !== null) {
                if (!$this->enseignersScheduledForDeletion->isEmpty()) {
                    \SilntiBundle\Model\EnseignerQuery::create()
                        ->filterByPrimaryKeys($this->enseignersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->enseignersScheduledForDeletion = null;
                }
            }

            if ($this->collEnseigners !== null) {
                foreach ($this->collEnseigners as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->epreuvesScheduledForDeletion !== null) {
                if (!$this->epreuvesScheduledForDeletion->isEmpty()) {
                    \SilntiBundle\Model\EpreuveQuery::create()
                        ->filterByPrimaryKeys($this->epreuvesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->epreuvesScheduledForDeletion = null;
                }
            }

            if ($this->collEpreuves !== null) {
                foreach ($this->collEpreuves as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->fichiersScheduledForDeletion !== null) {
                if (!$this->fichiersScheduledForDeletion->isEmpty()) {
                    \SilntiBundle\Model\FichierQuery::create()
                        ->filterByPrimaryKeys($this->fichiersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->fichiersScheduledForDeletion = null;
                }
            }

            if ($this->collFichiers !== null) {
                foreach ($this->collFichiers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[CoursTableMap::COL_ID_COURS] = true;
        if (null !== $this->id_cours) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CoursTableMap::COL_ID_COURS . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CoursTableMap::COL_ID_COURS)) {
            $modifiedColumns[':p' . $index++]  = 'id_cours';
        }
        if ($this->isColumnModified(CoursTableMap::COL_LIBELLE)) {
            $modifiedColumns[':p' . $index++]  = 'libelle';
        }

        $sql = sprintf(
            'INSERT INTO cours (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_cours':
                        $stmt->bindValue($identifier, $this->id_cours, PDO::PARAM_INT);
                        break;
                    case 'libelle':
                        $stmt->bindValue($identifier, $this->libelle, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdCours($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CoursTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIdCours();
                break;
            case 1:
                return $this->getLibelle();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Cours'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Cours'][$this->hashCode()] = true;
        $keys = CoursTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdCours(),
            $keys[1] => $this->getLibelle(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collEnseigners) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'enseigners';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'enseigners';
                        break;
                    default:
                        $key = 'Enseigners';
                }

                $result[$key] = $this->collEnseigners->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEpreuves) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'epreuves';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'epreuves';
                        break;
                    default:
                        $key = 'Epreuves';
                }

                $result[$key] = $this->collEpreuves->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collFichiers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'fichiers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'fichiers';
                        break;
                    default:
                        $key = 'Fichiers';
                }

                $result[$key] = $this->collFichiers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\SilntiBundle\Model\Cours
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CoursTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\SilntiBundle\Model\Cours
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdCours($value);
                break;
            case 1:
                $this->setLibelle($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = CoursTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdCours($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setLibelle($arr[$keys[1]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\SilntiBundle\Model\Cours The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(CoursTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CoursTableMap::COL_ID_COURS)) {
            $criteria->add(CoursTableMap::COL_ID_COURS, $this->id_cours);
        }
        if ($this->isColumnModified(CoursTableMap::COL_LIBELLE)) {
            $criteria->add(CoursTableMap::COL_LIBELLE, $this->libelle);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildCoursQuery::create();
        $criteria->add(CoursTableMap::COL_ID_COURS, $this->id_cours);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getIdCours();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdCours();
    }

    /**
     * Generic method to set the primary key (id_cours column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdCours($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdCours();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \SilntiBundle\Model\Cours (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setLibelle($this->getLibelle());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getEnseigners() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEnseigner($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEpreuves() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEpreuve($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getFichiers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFichier($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCours(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \SilntiBundle\Model\Cours Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Enseigner' == $relationName) {
            return $this->initEnseigners();
        }
        if ('Epreuve' == $relationName) {
            return $this->initEpreuves();
        }
        if ('Fichier' == $relationName) {
            return $this->initFichiers();
        }
    }

    /**
     * Clears out the collEnseigners collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEnseigners()
     */
    public function clearEnseigners()
    {
        $this->collEnseigners = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collEnseigners collection loaded partially.
     */
    public function resetPartialEnseigners($v = true)
    {
        $this->collEnseignersPartial = $v;
    }

    /**
     * Initializes the collEnseigners collection.
     *
     * By default this just sets the collEnseigners collection to an empty array (like clearcollEnseigners());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEnseigners($overrideExisting = true)
    {
        if (null !== $this->collEnseigners && !$overrideExisting) {
            return;
        }

        $collectionClassName = EnseignerTableMap::getTableMap()->getCollectionClassName();

        $this->collEnseigners = new $collectionClassName;
        $this->collEnseigners->setModel('\SilntiBundle\Model\Enseigner');
    }

    /**
     * Gets an array of ChildEnseigner objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCours is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEnseigner[] List of ChildEnseigner objects
     * @throws PropelException
     */
    public function getEnseigners(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collEnseignersPartial && !$this->isNew();
        if (null === $this->collEnseigners || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEnseigners) {
                // return empty collection
                $this->initEnseigners();
            } else {
                $collEnseigners = ChildEnseignerQuery::create(null, $criteria)
                    ->filterByCours($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEnseignersPartial && count($collEnseigners)) {
                        $this->initEnseigners(false);

                        foreach ($collEnseigners as $obj) {
                            if (false == $this->collEnseigners->contains($obj)) {
                                $this->collEnseigners->append($obj);
                            }
                        }

                        $this->collEnseignersPartial = true;
                    }

                    return $collEnseigners;
                }

                if ($partial && $this->collEnseigners) {
                    foreach ($this->collEnseigners as $obj) {
                        if ($obj->isNew()) {
                            $collEnseigners[] = $obj;
                        }
                    }
                }

                $this->collEnseigners = $collEnseigners;
                $this->collEnseignersPartial = false;
            }
        }

        return $this->collEnseigners;
    }

    /**
     * Sets a collection of ChildEnseigner objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $enseigners A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCours The current object (for fluent API support)
     */
    public function setEnseigners(Collection $enseigners, ConnectionInterface $con = null)
    {
        /** @var ChildEnseigner[] $enseignersToDelete */
        $enseignersToDelete = $this->getEnseigners(new Criteria(), $con)->diff($enseigners);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->enseignersScheduledForDeletion = clone $enseignersToDelete;

        foreach ($enseignersToDelete as $enseignerRemoved) {
            $enseignerRemoved->setCours(null);
        }

        $this->collEnseigners = null;
        foreach ($enseigners as $enseigner) {
            $this->addEnseigner($enseigner);
        }

        $this->collEnseigners = $enseigners;
        $this->collEnseignersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Enseigner objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Enseigner objects.
     * @throws PropelException
     */
    public function countEnseigners(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collEnseignersPartial && !$this->isNew();
        if (null === $this->collEnseigners || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEnseigners) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEnseigners());
            }

            $query = ChildEnseignerQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCours($this)
                ->count($con);
        }

        return count($this->collEnseigners);
    }

    /**
     * Method called to associate a ChildEnseigner object to this object
     * through the ChildEnseigner foreign key attribute.
     *
     * @param  ChildEnseigner $l ChildEnseigner
     * @return $this|\SilntiBundle\Model\Cours The current object (for fluent API support)
     */
    public function addEnseigner(ChildEnseigner $l)
    {
        if ($this->collEnseigners === null) {
            $this->initEnseigners();
            $this->collEnseignersPartial = true;
        }

        if (!$this->collEnseigners->contains($l)) {
            $this->doAddEnseigner($l);

            if ($this->enseignersScheduledForDeletion and $this->enseignersScheduledForDeletion->contains($l)) {
                $this->enseignersScheduledForDeletion->remove($this->enseignersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEnseigner $enseigner The ChildEnseigner object to add.
     */
    protected function doAddEnseigner(ChildEnseigner $enseigner)
    {
        $this->collEnseigners[]= $enseigner;
        $enseigner->setCours($this);
    }

    /**
     * @param  ChildEnseigner $enseigner The ChildEnseigner object to remove.
     * @return $this|ChildCours The current object (for fluent API support)
     */
    public function removeEnseigner(ChildEnseigner $enseigner)
    {
        if ($this->getEnseigners()->contains($enseigner)) {
            $pos = $this->collEnseigners->search($enseigner);
            $this->collEnseigners->remove($pos);
            if (null === $this->enseignersScheduledForDeletion) {
                $this->enseignersScheduledForDeletion = clone $this->collEnseigners;
                $this->enseignersScheduledForDeletion->clear();
            }
            $this->enseignersScheduledForDeletion[]= clone $enseigner;
            $enseigner->setCours(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Cours is new, it will return
     * an empty collection; or if this Cours has previously
     * been saved, it will retrieve related Enseigners from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Cours.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEnseigner[] List of ChildEnseigner objects
     */
    public function getEnseignersJoinUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEnseignerQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getEnseigners($query, $con);
    }

    /**
     * Clears out the collEpreuves collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEpreuves()
     */
    public function clearEpreuves()
    {
        $this->collEpreuves = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collEpreuves collection loaded partially.
     */
    public function resetPartialEpreuves($v = true)
    {
        $this->collEpreuvesPartial = $v;
    }

    /**
     * Initializes the collEpreuves collection.
     *
     * By default this just sets the collEpreuves collection to an empty array (like clearcollEpreuves());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEpreuves($overrideExisting = true)
    {
        if (null !== $this->collEpreuves && !$overrideExisting) {
            return;
        }

        $collectionClassName = EpreuveTableMap::getTableMap()->getCollectionClassName();

        $this->collEpreuves = new $collectionClassName;
        $this->collEpreuves->setModel('\SilntiBundle\Model\Epreuve');
    }

    /**
     * Gets an array of ChildEpreuve objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCours is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEpreuve[] List of ChildEpreuve objects
     * @throws PropelException
     */
    public function getEpreuves(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collEpreuvesPartial && !$this->isNew();
        if (null === $this->collEpreuves || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEpreuves) {
                // return empty collection
                $this->initEpreuves();
            } else {
                $collEpreuves = ChildEpreuveQuery::create(null, $criteria)
                    ->filterByCours($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEpreuvesPartial && count($collEpreuves)) {
                        $this->initEpreuves(false);

                        foreach ($collEpreuves as $obj) {
                            if (false == $this->collEpreuves->contains($obj)) {
                                $this->collEpreuves->append($obj);
                            }
                        }

                        $this->collEpreuvesPartial = true;
                    }

                    return $collEpreuves;
                }

                if ($partial && $this->collEpreuves) {
                    foreach ($this->collEpreuves as $obj) {
                        if ($obj->isNew()) {
                            $collEpreuves[] = $obj;
                        }
                    }
                }

                $this->collEpreuves = $collEpreuves;
                $this->collEpreuvesPartial = false;
            }
        }

        return $this->collEpreuves;
    }

    /**
     * Sets a collection of ChildEpreuve objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $epreuves A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCours The current object (for fluent API support)
     */
    public function setEpreuves(Collection $epreuves, ConnectionInterface $con = null)
    {
        /** @var ChildEpreuve[] $epreuvesToDelete */
        $epreuvesToDelete = $this->getEpreuves(new Criteria(), $con)->diff($epreuves);


        $this->epreuvesScheduledForDeletion = $epreuvesToDelete;

        foreach ($epreuvesToDelete as $epreuveRemoved) {
            $epreuveRemoved->setCours(null);
        }

        $this->collEpreuves = null;
        foreach ($epreuves as $epreuve) {
            $this->addEpreuve($epreuve);
        }

        $this->collEpreuves = $epreuves;
        $this->collEpreuvesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Epreuve objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Epreuve objects.
     * @throws PropelException
     */
    public function countEpreuves(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collEpreuvesPartial && !$this->isNew();
        if (null === $this->collEpreuves || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEpreuves) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEpreuves());
            }

            $query = ChildEpreuveQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCours($this)
                ->count($con);
        }

        return count($this->collEpreuves);
    }

    /**
     * Method called to associate a ChildEpreuve object to this object
     * through the ChildEpreuve foreign key attribute.
     *
     * @param  ChildEpreuve $l ChildEpreuve
     * @return $this|\SilntiBundle\Model\Cours The current object (for fluent API support)
     */
    public function addEpreuve(ChildEpreuve $l)
    {
        if ($this->collEpreuves === null) {
            $this->initEpreuves();
            $this->collEpreuvesPartial = true;
        }

        if (!$this->collEpreuves->contains($l)) {
            $this->doAddEpreuve($l);

            if ($this->epreuvesScheduledForDeletion and $this->epreuvesScheduledForDeletion->contains($l)) {
                $this->epreuvesScheduledForDeletion->remove($this->epreuvesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEpreuve $epreuve The ChildEpreuve object to add.
     */
    protected function doAddEpreuve(ChildEpreuve $epreuve)
    {
        $this->collEpreuves[]= $epreuve;
        $epreuve->setCours($this);
    }

    /**
     * @param  ChildEpreuve $epreuve The ChildEpreuve object to remove.
     * @return $this|ChildCours The current object (for fluent API support)
     */
    public function removeEpreuve(ChildEpreuve $epreuve)
    {
        if ($this->getEpreuves()->contains($epreuve)) {
            $pos = $this->collEpreuves->search($epreuve);
            $this->collEpreuves->remove($pos);
            if (null === $this->epreuvesScheduledForDeletion) {
                $this->epreuvesScheduledForDeletion = clone $this->collEpreuves;
                $this->epreuvesScheduledForDeletion->clear();
            }
            $this->epreuvesScheduledForDeletion[]= clone $epreuve;
            $epreuve->setCours(null);
        }

        return $this;
    }

    /**
     * Clears out the collFichiers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addFichiers()
     */
    public function clearFichiers()
    {
        $this->collFichiers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collFichiers collection loaded partially.
     */
    public function resetPartialFichiers($v = true)
    {
        $this->collFichiersPartial = $v;
    }

    /**
     * Initializes the collFichiers collection.
     *
     * By default this just sets the collFichiers collection to an empty array (like clearcollFichiers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initFichiers($overrideExisting = true)
    {
        if (null !== $this->collFichiers && !$overrideExisting) {
            return;
        }

        $collectionClassName = FichierTableMap::getTableMap()->getCollectionClassName();

        $this->collFichiers = new $collectionClassName;
        $this->collFichiers->setModel('\SilntiBundle\Model\Fichier');
    }

    /**
     * Gets an array of ChildFichier objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCours is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildFichier[] List of ChildFichier objects
     * @throws PropelException
     */
    public function getFichiers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collFichiersPartial && !$this->isNew();
        if (null === $this->collFichiers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collFichiers) {
                // return empty collection
                $this->initFichiers();
            } else {
                $collFichiers = ChildFichierQuery::create(null, $criteria)
                    ->filterByCours($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collFichiersPartial && count($collFichiers)) {
                        $this->initFichiers(false);

                        foreach ($collFichiers as $obj) {
                            if (false == $this->collFichiers->contains($obj)) {
                                $this->collFichiers->append($obj);
                            }
                        }

                        $this->collFichiersPartial = true;
                    }

                    return $collFichiers;
                }

                if ($partial && $this->collFichiers) {
                    foreach ($this->collFichiers as $obj) {
                        if ($obj->isNew()) {
                            $collFichiers[] = $obj;
                        }
                    }
                }

                $this->collFichiers = $collFichiers;
                $this->collFichiersPartial = false;
            }
        }

        return $this->collFichiers;
    }

    /**
     * Sets a collection of ChildFichier objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $fichiers A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCours The current object (for fluent API support)
     */
    public function setFichiers(Collection $fichiers, ConnectionInterface $con = null)
    {
        /** @var ChildFichier[] $fichiersToDelete */
        $fichiersToDelete = $this->getFichiers(new Criteria(), $con)->diff($fichiers);


        $this->fichiersScheduledForDeletion = $fichiersToDelete;

        foreach ($fichiersToDelete as $fichierRemoved) {
            $fichierRemoved->setCours(null);
        }

        $this->collFichiers = null;
        foreach ($fichiers as $fichier) {
            $this->addFichier($fichier);
        }

        $this->collFichiers = $fichiers;
        $this->collFichiersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Fichier objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Fichier objects.
     * @throws PropelException
     */
    public function countFichiers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collFichiersPartial && !$this->isNew();
        if (null === $this->collFichiers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collFichiers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getFichiers());
            }

            $query = ChildFichierQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCours($this)
                ->count($con);
        }

        return count($this->collFichiers);
    }

    /**
     * Method called to associate a ChildFichier object to this object
     * through the ChildFichier foreign key attribute.
     *
     * @param  ChildFichier $l ChildFichier
     * @return $this|\SilntiBundle\Model\Cours The current object (for fluent API support)
     */
    public function addFichier(ChildFichier $l)
    {
        if ($this->collFichiers === null) {
            $this->initFichiers();
            $this->collFichiersPartial = true;
        }

        if (!$this->collFichiers->contains($l)) {
            $this->doAddFichier($l);

            if ($this->fichiersScheduledForDeletion and $this->fichiersScheduledForDeletion->contains($l)) {
                $this->fichiersScheduledForDeletion->remove($this->fichiersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildFichier $fichier The ChildFichier object to add.
     */
    protected function doAddFichier(ChildFichier $fichier)
    {
        $this->collFichiers[]= $fichier;
        $fichier->setCours($this);
    }

    /**
     * @param  ChildFichier $fichier The ChildFichier object to remove.
     * @return $this|ChildCours The current object (for fluent API support)
     */
    public function removeFichier(ChildFichier $fichier)
    {
        if ($this->getFichiers()->contains($fichier)) {
            $pos = $this->collFichiers->search($fichier);
            $this->collFichiers->remove($pos);
            if (null === $this->fichiersScheduledForDeletion) {
                $this->fichiersScheduledForDeletion = clone $this->collFichiers;
                $this->fichiersScheduledForDeletion->clear();
            }
            $this->fichiersScheduledForDeletion[]= clone $fichier;
            $fichier->setCours(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Cours is new, it will return
     * an empty collection; or if this Cours has previously
     * been saved, it will retrieve related Fichiers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Cours.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFichier[] List of ChildFichier objects
     */
    public function getFichiersJoinUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFichierQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getFichiers($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id_cours = null;
        $this->libelle = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collEnseigners) {
                foreach ($this->collEnseigners as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEpreuves) {
                foreach ($this->collEpreuves as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collFichiers) {
                foreach ($this->collFichiers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collEnseigners = null;
        $this->collEpreuves = null;
        $this->collFichiers = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CoursTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
