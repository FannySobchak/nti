<?php

namespace SilntiBundle\Model\Base;

use \DateTime;
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
use Propel\Runtime\Util\PropelDateTime;
use SilntiBundle\Model\Etudiant as ChildEtudiant;
use SilntiBundle\Model\EtudiantQuery as ChildEtudiantQuery;
use SilntiBundle\Model\Note as ChildNote;
use SilntiBundle\Model\NoteQuery as ChildNoteQuery;
use SilntiBundle\Model\Session as ChildSession;
use SilntiBundle\Model\SessionQuery as ChildSessionQuery;
use SilntiBundle\Model\Map\EtudiantTableMap;
use SilntiBundle\Model\Map\NoteTableMap;
use SilntiBundle\Model\Map\SessionTableMap;

/**
 * Base class that represents a row from the 'session' table.
 *
 *
 *
* @package    propel.generator.src.SilntiBundle.Model.Base
*/
abstract class Session implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\SilntiBundle\\Model\\Map\\SessionTableMap';


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
     * The value for the id_session field.
     *
     * @var        int
     */
    protected $id_session;

    /**
     * The value for the libelle field.
     *
     * @var        string
     */
    protected $libelle;

    /**
     * The value for the date_inscription field.
     *
     * @var        DateTime
     */
    protected $date_inscription;

    /**
     * @var        ObjectCollection|ChildEtudiant[] Collection to store aggregation of ChildEtudiant objects.
     */
    protected $collEtudiants;
    protected $collEtudiantsPartial;

    /**
     * @var        ObjectCollection|ChildNote[] Collection to store aggregation of ChildNote objects.
     */
    protected $collNotes;
    protected $collNotesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEtudiant[]
     */
    protected $etudiantsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildNote[]
     */
    protected $notesScheduledForDeletion = null;

    /**
     * Initializes internal state of SilntiBundle\Model\Base\Session object.
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
     * Compares this with another <code>Session</code> instance.  If
     * <code>obj</code> is an instance of <code>Session</code>, delegates to
     * <code>equals(Session)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Session The current object, for fluid interface
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
     * Get the [id_session] column value.
     *
     * @return int
     */
    public function getIdSession()
    {
        return $this->id_session;
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
     * Get the [optionally formatted] temporal [date_inscription] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateInscription($format = NULL)
    {
        if ($format === null) {
            return $this->date_inscription;
        } else {
            return $this->date_inscription instanceof \DateTimeInterface ? $this->date_inscription->format($format) : null;
        }
    }

    /**
     * Set the value of [id_session] column.
     *
     * @param int $v new value
     * @return $this|\SilntiBundle\Model\Session The current object (for fluent API support)
     */
    public function setIdSession($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_session !== $v) {
            $this->id_session = $v;
            $this->modifiedColumns[SessionTableMap::COL_ID_SESSION] = true;
        }

        return $this;
    } // setIdSession()

    /**
     * Set the value of [libelle] column.
     *
     * @param string $v new value
     * @return $this|\SilntiBundle\Model\Session The current object (for fluent API support)
     */
    public function setLibelle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->libelle !== $v) {
            $this->libelle = $v;
            $this->modifiedColumns[SessionTableMap::COL_LIBELLE] = true;
        }

        return $this;
    } // setLibelle()

    /**
     * Sets the value of [date_inscription] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\SilntiBundle\Model\Session The current object (for fluent API support)
     */
    public function setDateInscription($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_inscription !== null || $dt !== null) {
            if ($this->date_inscription === null || $dt === null || $dt->format("Y-m-d") !== $this->date_inscription->format("Y-m-d")) {
                $this->date_inscription = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SessionTableMap::COL_DATE_INSCRIPTION] = true;
            }
        } // if either are not null

        return $this;
    } // setDateInscription()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SessionTableMap::translateFieldName('IdSession', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_session = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SessionTableMap::translateFieldName('Libelle', TableMap::TYPE_PHPNAME, $indexType)];
            $this->libelle = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SessionTableMap::translateFieldName('DateInscription', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->date_inscription = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = SessionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\SilntiBundle\\Model\\Session'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SessionTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSessionQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collEtudiants = null;

            $this->collNotes = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Session::setDeleted()
     * @see Session::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SessionTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSessionQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SessionTableMap::DATABASE_NAME);
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
                SessionTableMap::addInstanceToPool($this);
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

            if ($this->etudiantsScheduledForDeletion !== null) {
                if (!$this->etudiantsScheduledForDeletion->isEmpty()) {
                    \SilntiBundle\Model\EtudiantQuery::create()
                        ->filterByPrimaryKeys($this->etudiantsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etudiantsScheduledForDeletion = null;
                }
            }

            if ($this->collEtudiants !== null) {
                foreach ($this->collEtudiants as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->notesScheduledForDeletion !== null) {
                if (!$this->notesScheduledForDeletion->isEmpty()) {
                    \SilntiBundle\Model\NoteQuery::create()
                        ->filterByPrimaryKeys($this->notesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->notesScheduledForDeletion = null;
                }
            }

            if ($this->collNotes !== null) {
                foreach ($this->collNotes as $referrerFK) {
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

        $this->modifiedColumns[SessionTableMap::COL_ID_SESSION] = true;
        if (null !== $this->id_session) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SessionTableMap::COL_ID_SESSION . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SessionTableMap::COL_ID_SESSION)) {
            $modifiedColumns[':p' . $index++]  = 'id_session';
        }
        if ($this->isColumnModified(SessionTableMap::COL_LIBELLE)) {
            $modifiedColumns[':p' . $index++]  = 'libelle';
        }
        if ($this->isColumnModified(SessionTableMap::COL_DATE_INSCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'date_inscription';
        }

        $sql = sprintf(
            'INSERT INTO session (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_session':
                        $stmt->bindValue($identifier, $this->id_session, PDO::PARAM_INT);
                        break;
                    case 'libelle':
                        $stmt->bindValue($identifier, $this->libelle, PDO::PARAM_STR);
                        break;
                    case 'date_inscription':
                        $stmt->bindValue($identifier, $this->date_inscription ? $this->date_inscription->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
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
        $this->setIdSession($pk);

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
        $pos = SessionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdSession();
                break;
            case 1:
                return $this->getLibelle();
                break;
            case 2:
                return $this->getDateInscription();
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

        if (isset($alreadyDumpedObjects['Session'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Session'][$this->hashCode()] = true;
        $keys = SessionTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdSession(),
            $keys[1] => $this->getLibelle(),
            $keys[2] => $this->getDateInscription(),
        );
        if ($result[$keys[2]] instanceof \DateTime) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collEtudiants) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'etudiants';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'etudiants';
                        break;
                    default:
                        $key = 'Etudiants';
                }

                $result[$key] = $this->collEtudiants->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNotes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'notes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'notes';
                        break;
                    default:
                        $key = 'Notes';
                }

                $result[$key] = $this->collNotes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\SilntiBundle\Model\Session
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SessionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\SilntiBundle\Model\Session
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdSession($value);
                break;
            case 1:
                $this->setLibelle($value);
                break;
            case 2:
                $this->setDateInscription($value);
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
        $keys = SessionTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdSession($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setLibelle($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDateInscription($arr[$keys[2]]);
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
     * @return $this|\SilntiBundle\Model\Session The current object, for fluid interface
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
        $criteria = new Criteria(SessionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SessionTableMap::COL_ID_SESSION)) {
            $criteria->add(SessionTableMap::COL_ID_SESSION, $this->id_session);
        }
        if ($this->isColumnModified(SessionTableMap::COL_LIBELLE)) {
            $criteria->add(SessionTableMap::COL_LIBELLE, $this->libelle);
        }
        if ($this->isColumnModified(SessionTableMap::COL_DATE_INSCRIPTION)) {
            $criteria->add(SessionTableMap::COL_DATE_INSCRIPTION, $this->date_inscription);
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
        $criteria = ChildSessionQuery::create();
        $criteria->add(SessionTableMap::COL_ID_SESSION, $this->id_session);

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
        $validPk = null !== $this->getIdSession();

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
        return $this->getIdSession();
    }

    /**
     * Generic method to set the primary key (id_session column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdSession($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdSession();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \SilntiBundle\Model\Session (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setLibelle($this->getLibelle());
        $copyObj->setDateInscription($this->getDateInscription());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getEtudiants() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtudiant($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNotes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNote($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdSession(NULL); // this is a auto-increment column, so set to default value
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
     * @return \SilntiBundle\Model\Session Clone of current object.
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
        if ('Etudiant' == $relationName) {
            return $this->initEtudiants();
        }
        if ('Note' == $relationName) {
            return $this->initNotes();
        }
    }

    /**
     * Clears out the collEtudiants collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEtudiants()
     */
    public function clearEtudiants()
    {
        $this->collEtudiants = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collEtudiants collection loaded partially.
     */
    public function resetPartialEtudiants($v = true)
    {
        $this->collEtudiantsPartial = $v;
    }

    /**
     * Initializes the collEtudiants collection.
     *
     * By default this just sets the collEtudiants collection to an empty array (like clearcollEtudiants());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtudiants($overrideExisting = true)
    {
        if (null !== $this->collEtudiants && !$overrideExisting) {
            return;
        }

        $collectionClassName = EtudiantTableMap::getTableMap()->getCollectionClassName();

        $this->collEtudiants = new $collectionClassName;
        $this->collEtudiants->setModel('\SilntiBundle\Model\Etudiant');
    }

    /**
     * Gets an array of ChildEtudiant objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSession is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEtudiant[] List of ChildEtudiant objects
     * @throws PropelException
     */
    public function getEtudiants(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collEtudiantsPartial && !$this->isNew();
        if (null === $this->collEtudiants || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEtudiants) {
                // return empty collection
                $this->initEtudiants();
            } else {
                $collEtudiants = ChildEtudiantQuery::create(null, $criteria)
                    ->filterBySession($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEtudiantsPartial && count($collEtudiants)) {
                        $this->initEtudiants(false);

                        foreach ($collEtudiants as $obj) {
                            if (false == $this->collEtudiants->contains($obj)) {
                                $this->collEtudiants->append($obj);
                            }
                        }

                        $this->collEtudiantsPartial = true;
                    }

                    return $collEtudiants;
                }

                if ($partial && $this->collEtudiants) {
                    foreach ($this->collEtudiants as $obj) {
                        if ($obj->isNew()) {
                            $collEtudiants[] = $obj;
                        }
                    }
                }

                $this->collEtudiants = $collEtudiants;
                $this->collEtudiantsPartial = false;
            }
        }

        return $this->collEtudiants;
    }

    /**
     * Sets a collection of ChildEtudiant objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $etudiants A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSession The current object (for fluent API support)
     */
    public function setEtudiants(Collection $etudiants, ConnectionInterface $con = null)
    {
        /** @var ChildEtudiant[] $etudiantsToDelete */
        $etudiantsToDelete = $this->getEtudiants(new Criteria(), $con)->diff($etudiants);


        $this->etudiantsScheduledForDeletion = $etudiantsToDelete;

        foreach ($etudiantsToDelete as $etudiantRemoved) {
            $etudiantRemoved->setSession(null);
        }

        $this->collEtudiants = null;
        foreach ($etudiants as $etudiant) {
            $this->addEtudiant($etudiant);
        }

        $this->collEtudiants = $etudiants;
        $this->collEtudiantsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Etudiant objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Etudiant objects.
     * @throws PropelException
     */
    public function countEtudiants(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collEtudiantsPartial && !$this->isNew();
        if (null === $this->collEtudiants || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtudiants) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEtudiants());
            }

            $query = ChildEtudiantQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySession($this)
                ->count($con);
        }

        return count($this->collEtudiants);
    }

    /**
     * Method called to associate a ChildEtudiant object to this object
     * through the ChildEtudiant foreign key attribute.
     *
     * @param  ChildEtudiant $l ChildEtudiant
     * @return $this|\SilntiBundle\Model\Session The current object (for fluent API support)
     */
    public function addEtudiant(ChildEtudiant $l)
    {
        if ($this->collEtudiants === null) {
            $this->initEtudiants();
            $this->collEtudiantsPartial = true;
        }

        if (!$this->collEtudiants->contains($l)) {
            $this->doAddEtudiant($l);

            if ($this->etudiantsScheduledForDeletion and $this->etudiantsScheduledForDeletion->contains($l)) {
                $this->etudiantsScheduledForDeletion->remove($this->etudiantsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEtudiant $etudiant The ChildEtudiant object to add.
     */
    protected function doAddEtudiant(ChildEtudiant $etudiant)
    {
        $this->collEtudiants[]= $etudiant;
        $etudiant->setSession($this);
    }

    /**
     * @param  ChildEtudiant $etudiant The ChildEtudiant object to remove.
     * @return $this|ChildSession The current object (for fluent API support)
     */
    public function removeEtudiant(ChildEtudiant $etudiant)
    {
        if ($this->getEtudiants()->contains($etudiant)) {
            $pos = $this->collEtudiants->search($etudiant);
            $this->collEtudiants->remove($pos);
            if (null === $this->etudiantsScheduledForDeletion) {
                $this->etudiantsScheduledForDeletion = clone $this->collEtudiants;
                $this->etudiantsScheduledForDeletion->clear();
            }
            $this->etudiantsScheduledForDeletion[]= clone $etudiant;
            $etudiant->setSession(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Session is new, it will return
     * an empty collection; or if this Session has previously
     * been saved, it will retrieve related Etudiants from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Session.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEtudiant[] List of ChildEtudiant objects
     */
    public function getEtudiantsJoinUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEtudiantQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getEtudiants($query, $con);
    }

    /**
     * Clears out the collNotes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addNotes()
     */
    public function clearNotes()
    {
        $this->collNotes = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collNotes collection loaded partially.
     */
    public function resetPartialNotes($v = true)
    {
        $this->collNotesPartial = $v;
    }

    /**
     * Initializes the collNotes collection.
     *
     * By default this just sets the collNotes collection to an empty array (like clearcollNotes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNotes($overrideExisting = true)
    {
        if (null !== $this->collNotes && !$overrideExisting) {
            return;
        }

        $collectionClassName = NoteTableMap::getTableMap()->getCollectionClassName();

        $this->collNotes = new $collectionClassName;
        $this->collNotes->setModel('\SilntiBundle\Model\Note');
    }

    /**
     * Gets an array of ChildNote objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSession is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildNote[] List of ChildNote objects
     * @throws PropelException
     */
    public function getNotes(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collNotesPartial && !$this->isNew();
        if (null === $this->collNotes || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNotes) {
                // return empty collection
                $this->initNotes();
            } else {
                $collNotes = ChildNoteQuery::create(null, $criteria)
                    ->filterBySession($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collNotesPartial && count($collNotes)) {
                        $this->initNotes(false);

                        foreach ($collNotes as $obj) {
                            if (false == $this->collNotes->contains($obj)) {
                                $this->collNotes->append($obj);
                            }
                        }

                        $this->collNotesPartial = true;
                    }

                    return $collNotes;
                }

                if ($partial && $this->collNotes) {
                    foreach ($this->collNotes as $obj) {
                        if ($obj->isNew()) {
                            $collNotes[] = $obj;
                        }
                    }
                }

                $this->collNotes = $collNotes;
                $this->collNotesPartial = false;
            }
        }

        return $this->collNotes;
    }

    /**
     * Sets a collection of ChildNote objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $notes A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSession The current object (for fluent API support)
     */
    public function setNotes(Collection $notes, ConnectionInterface $con = null)
    {
        /** @var ChildNote[] $notesToDelete */
        $notesToDelete = $this->getNotes(new Criteria(), $con)->diff($notes);


        $this->notesScheduledForDeletion = $notesToDelete;

        foreach ($notesToDelete as $noteRemoved) {
            $noteRemoved->setSession(null);
        }

        $this->collNotes = null;
        foreach ($notes as $note) {
            $this->addNote($note);
        }

        $this->collNotes = $notes;
        $this->collNotesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Note objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Note objects.
     * @throws PropelException
     */
    public function countNotes(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collNotesPartial && !$this->isNew();
        if (null === $this->collNotes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNotes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNotes());
            }

            $query = ChildNoteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySession($this)
                ->count($con);
        }

        return count($this->collNotes);
    }

    /**
     * Method called to associate a ChildNote object to this object
     * through the ChildNote foreign key attribute.
     *
     * @param  ChildNote $l ChildNote
     * @return $this|\SilntiBundle\Model\Session The current object (for fluent API support)
     */
    public function addNote(ChildNote $l)
    {
        if ($this->collNotes === null) {
            $this->initNotes();
            $this->collNotesPartial = true;
        }

        if (!$this->collNotes->contains($l)) {
            $this->doAddNote($l);

            if ($this->notesScheduledForDeletion and $this->notesScheduledForDeletion->contains($l)) {
                $this->notesScheduledForDeletion->remove($this->notesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildNote $note The ChildNote object to add.
     */
    protected function doAddNote(ChildNote $note)
    {
        $this->collNotes[]= $note;
        $note->setSession($this);
    }

    /**
     * @param  ChildNote $note The ChildNote object to remove.
     * @return $this|ChildSession The current object (for fluent API support)
     */
    public function removeNote(ChildNote $note)
    {
        if ($this->getNotes()->contains($note)) {
            $pos = $this->collNotes->search($note);
            $this->collNotes->remove($pos);
            if (null === $this->notesScheduledForDeletion) {
                $this->notesScheduledForDeletion = clone $this->collNotes;
                $this->notesScheduledForDeletion->clear();
            }
            $this->notesScheduledForDeletion[]= clone $note;
            $note->setSession(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Session is new, it will return
     * an empty collection; or if this Session has previously
     * been saved, it will retrieve related Notes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Session.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildNote[] List of ChildNote objects
     */
    public function getNotesJoinEpreuve(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildNoteQuery::create(null, $criteria);
        $query->joinWith('Epreuve', $joinBehavior);

        return $this->getNotes($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Session is new, it will return
     * an empty collection; or if this Session has previously
     * been saved, it will retrieve related Notes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Session.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildNote[] List of ChildNote objects
     */
    public function getNotesJoinUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildNoteQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getNotes($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id_session = null;
        $this->libelle = null;
        $this->date_inscription = null;
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
            if ($this->collEtudiants) {
                foreach ($this->collEtudiants as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNotes) {
                foreach ($this->collNotes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collEtudiants = null;
        $this->collNotes = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SessionTableMap::DEFAULT_STRING_FORMAT);
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
