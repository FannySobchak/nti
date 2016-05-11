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
use SilntiBundle\Model\Actualite as ChildActualite;
use SilntiBundle\Model\ActualiteQuery as ChildActualiteQuery;
use SilntiBundle\Model\Enseigner as ChildEnseigner;
use SilntiBundle\Model\EnseignerQuery as ChildEnseignerQuery;
use SilntiBundle\Model\Etudiant as ChildEtudiant;
use SilntiBundle\Model\EtudiantQuery as ChildEtudiantQuery;
use SilntiBundle\Model\Fichier as ChildFichier;
use SilntiBundle\Model\FichierQuery as ChildFichierQuery;
use SilntiBundle\Model\Note as ChildNote;
use SilntiBundle\Model\NoteQuery as ChildNoteQuery;
use SilntiBundle\Model\Page as ChildPage;
use SilntiBundle\Model\PageQuery as ChildPageQuery;
use SilntiBundle\Model\Prof as ChildProf;
use SilntiBundle\Model\ProfQuery as ChildProfQuery;
use SilntiBundle\Model\User as ChildUser;
use SilntiBundle\Model\UserQuery as ChildUserQuery;
use SilntiBundle\Model\Map\ActualiteTableMap;
use SilntiBundle\Model\Map\EnseignerTableMap;
use SilntiBundle\Model\Map\FichierTableMap;
use SilntiBundle\Model\Map\NoteTableMap;
use SilntiBundle\Model\Map\PageTableMap;
use SilntiBundle\Model\Map\UserTableMap;

/**
 * Base class that represents a row from the 'user' table.
 *
 *
 *
* @package    propel.generator.src\SilntiBundle.Model.Base
*/
abstract class User implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\SilntiBundle\\Model\\Map\\UserTableMap';


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
     * The value for the id_user field.
     *
     * @var        int
     */
    protected $id_user;

    /**
     * The value for the nom field.
     *
     * @var        string
     */
    protected $nom;

    /**
     * The value for the prenom field.
     *
     * @var        string
     */
    protected $prenom;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the mdp field.
     *
     * @var        string
     */
    protected $mdp;

    /**
     * The value for the tel field.
     *
     * @var        string
     */
    protected $tel;

    /**
     * The value for the droit field.
     *
     * @var        int
     */
    protected $droit;

    /**
     * The value for the photo field.
     *
     * @var        string
     */
    protected $photo;

    /**
     * @var        ObjectCollection|ChildActualite[] Collection to store aggregation of ChildActualite objects.
     */
    protected $collActualites;
    protected $collActualitesPartial;

    /**
     * @var        ObjectCollection|ChildEnseigner[] Collection to store aggregation of ChildEnseigner objects.
     */
    protected $collEnseigners;
    protected $collEnseignersPartial;

    /**
     * @var        ChildEtudiant one-to-one related ChildEtudiant object
     */
    protected $singleEtudiant;

    /**
     * @var        ObjectCollection|ChildFichier[] Collection to store aggregation of ChildFichier objects.
     */
    protected $collFichiers;
    protected $collFichiersPartial;

    /**
     * @var        ObjectCollection|ChildNote[] Collection to store aggregation of ChildNote objects.
     */
    protected $collNotes;
    protected $collNotesPartial;

    /**
     * @var        ObjectCollection|ChildPage[] Collection to store aggregation of ChildPage objects.
     */
    protected $collPages;
    protected $collPagesPartial;

    /**
     * @var        ChildProf one-to-one related ChildProf object
     */
    protected $singleProf;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildActualite[]
     */
    protected $actualitesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEnseigner[]
     */
    protected $enseignersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFichier[]
     */
    protected $fichiersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildNote[]
     */
    protected $notesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPage[]
     */
    protected $pagesScheduledForDeletion = null;

    /**
     * Initializes internal state of SilntiBundle\Model\Base\User object.
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
     * Compares this with another <code>User</code> instance.  If
     * <code>obj</code> is an instance of <code>User</code>, delegates to
     * <code>equals(User)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|User The current object, for fluid interface
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
     * Get the [id_user] column value.
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * Get the [nom] column value.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Get the [prenom] column value.
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [mdp] column value.
     *
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Get the [tel] column value.
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Get the [droit] column value.
     *
     * @return int
     */
    public function getDroit()
    {
        return $this->droit;
    }

    /**
     * Get the [photo] column value.
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of [id_user] column.
     *
     * @param int $v new value
     * @return $this|\SilntiBundle\Model\User The current object (for fluent API support)
     */
    public function setIdUser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_user !== $v) {
            $this->id_user = $v;
            $this->modifiedColumns[UserTableMap::COL_ID_USER] = true;
        }

        return $this;
    } // setIdUser()

    /**
     * Set the value of [nom] column.
     *
     * @param string $v new value
     * @return $this|\SilntiBundle\Model\User The current object (for fluent API support)
     */
    public function setNom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nom !== $v) {
            $this->nom = $v;
            $this->modifiedColumns[UserTableMap::COL_NOM] = true;
        }

        return $this;
    } // setNom()

    /**
     * Set the value of [prenom] column.
     *
     * @param string $v new value
     * @return $this|\SilntiBundle\Model\User The current object (for fluent API support)
     */
    public function setPrenom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->prenom !== $v) {
            $this->prenom = $v;
            $this->modifiedColumns[UserTableMap::COL_PRENOM] = true;
        }

        return $this;
    } // setPrenom()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\SilntiBundle\Model\User The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[UserTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [mdp] column.
     *
     * @param string $v new value
     * @return $this|\SilntiBundle\Model\User The current object (for fluent API support)
     */
    public function setMdp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mdp !== $v) {
            $this->mdp = $v;
            $this->modifiedColumns[UserTableMap::COL_MDP] = true;
        }

        return $this;
    } // setMdp()

    /**
     * Set the value of [tel] column.
     *
     * @param string $v new value
     * @return $this|\SilntiBundle\Model\User The current object (for fluent API support)
     */
    public function setTel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tel !== $v) {
            $this->tel = $v;
            $this->modifiedColumns[UserTableMap::COL_TEL] = true;
        }

        return $this;
    } // setTel()

    /**
     * Set the value of [droit] column.
     *
     * @param int $v new value
     * @return $this|\SilntiBundle\Model\User The current object (for fluent API support)
     */
    public function setDroit($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->droit !== $v) {
            $this->droit = $v;
            $this->modifiedColumns[UserTableMap::COL_DROIT] = true;
        }

        return $this;
    } // setDroit()

    /**
     * Set the value of [photo] column.
     *
     * @param string $v new value
     * @return $this|\SilntiBundle\Model\User The current object (for fluent API support)
     */
    public function setPhoto($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->photo !== $v) {
            $this->photo = $v;
            $this->modifiedColumns[UserTableMap::COL_PHOTO] = true;
        }

        return $this;
    } // setPhoto()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UserTableMap::translateFieldName('IdUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UserTableMap::translateFieldName('Nom', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nom = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UserTableMap::translateFieldName('Prenom', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prenom = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UserTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UserTableMap::translateFieldName('Mdp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mdp = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UserTableMap::translateFieldName('Tel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tel = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UserTableMap::translateFieldName('Droit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->droit = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UserTableMap::translateFieldName('Photo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->photo = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = UserTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\SilntiBundle\\Model\\User'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(UserTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUserQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collActualites = null;

            $this->collEnseigners = null;

            $this->singleEtudiant = null;

            $this->collFichiers = null;

            $this->collNotes = null;

            $this->collPages = null;

            $this->singleProf = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see User::setDeleted()
     * @see User::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUserQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
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
                UserTableMap::addInstanceToPool($this);
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

            if ($this->actualitesScheduledForDeletion !== null) {
                if (!$this->actualitesScheduledForDeletion->isEmpty()) {
                    \SilntiBundle\Model\ActualiteQuery::create()
                        ->filterByPrimaryKeys($this->actualitesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->actualitesScheduledForDeletion = null;
                }
            }

            if ($this->collActualites !== null) {
                foreach ($this->collActualites as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

            if ($this->singleEtudiant !== null) {
                if (!$this->singleEtudiant->isDeleted() && ($this->singleEtudiant->isNew() || $this->singleEtudiant->isModified())) {
                    $affectedRows += $this->singleEtudiant->save($con);
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

            if ($this->pagesScheduledForDeletion !== null) {
                if (!$this->pagesScheduledForDeletion->isEmpty()) {
                    \SilntiBundle\Model\PageQuery::create()
                        ->filterByPrimaryKeys($this->pagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pagesScheduledForDeletion = null;
                }
            }

            if ($this->collPages !== null) {
                foreach ($this->collPages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->singleProf !== null) {
                if (!$this->singleProf->isDeleted() && ($this->singleProf->isNew() || $this->singleProf->isModified())) {
                    $affectedRows += $this->singleProf->save($con);
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

        $this->modifiedColumns[UserTableMap::COL_ID_USER] = true;
        if (null !== $this->id_user) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserTableMap::COL_ID_USER . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserTableMap::COL_ID_USER)) {
            $modifiedColumns[':p' . $index++]  = 'id_user';
        }
        if ($this->isColumnModified(UserTableMap::COL_NOM)) {
            $modifiedColumns[':p' . $index++]  = 'nom';
        }
        if ($this->isColumnModified(UserTableMap::COL_PRENOM)) {
            $modifiedColumns[':p' . $index++]  = 'prenom';
        }
        if ($this->isColumnModified(UserTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(UserTableMap::COL_MDP)) {
            $modifiedColumns[':p' . $index++]  = 'mdp';
        }
        if ($this->isColumnModified(UserTableMap::COL_TEL)) {
            $modifiedColumns[':p' . $index++]  = 'tel';
        }
        if ($this->isColumnModified(UserTableMap::COL_DROIT)) {
            $modifiedColumns[':p' . $index++]  = 'droit';
        }
        if ($this->isColumnModified(UserTableMap::COL_PHOTO)) {
            $modifiedColumns[':p' . $index++]  = 'photo';
        }

        $sql = sprintf(
            'INSERT INTO user (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_user':
                        $stmt->bindValue($identifier, $this->id_user, PDO::PARAM_INT);
                        break;
                    case 'nom':
                        $stmt->bindValue($identifier, $this->nom, PDO::PARAM_STR);
                        break;
                    case 'prenom':
                        $stmt->bindValue($identifier, $this->prenom, PDO::PARAM_STR);
                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'mdp':
                        $stmt->bindValue($identifier, $this->mdp, PDO::PARAM_STR);
                        break;
                    case 'tel':
                        $stmt->bindValue($identifier, $this->tel, PDO::PARAM_STR);
                        break;
                    case 'droit':
                        $stmt->bindValue($identifier, $this->droit, PDO::PARAM_INT);
                        break;
                    case 'photo':
                        $stmt->bindValue($identifier, $this->photo, PDO::PARAM_STR);
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
        $this->setIdUser($pk);

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
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdUser();
                break;
            case 1:
                return $this->getNom();
                break;
            case 2:
                return $this->getPrenom();
                break;
            case 3:
                return $this->getEmail();
                break;
            case 4:
                return $this->getMdp();
                break;
            case 5:
                return $this->getTel();
                break;
            case 6:
                return $this->getDroit();
                break;
            case 7:
                return $this->getPhoto();
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

        if (isset($alreadyDumpedObjects['User'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['User'][$this->hashCode()] = true;
        $keys = UserTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdUser(),
            $keys[1] => $this->getNom(),
            $keys[2] => $this->getPrenom(),
            $keys[3] => $this->getEmail(),
            $keys[4] => $this->getMdp(),
            $keys[5] => $this->getTel(),
            $keys[6] => $this->getDroit(),
            $keys[7] => $this->getPhoto(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collActualites) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'actualites';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'actualites';
                        break;
                    default:
                        $key = 'Actualites';
                }

                $result[$key] = $this->collActualites->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
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
            if (null !== $this->singleEtudiant) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'etudiant';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'etudiant';
                        break;
                    default:
                        $key = 'Etudiant';
                }

                $result[$key] = $this->singleEtudiant->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
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
            if (null !== $this->collPages) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pages';
                        break;
                    default:
                        $key = 'Pages';
                }

                $result[$key] = $this->collPages->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->singleProf) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'prof';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'prof';
                        break;
                    default:
                        $key = 'Prof';
                }

                $result[$key] = $this->singleProf->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
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
     * @return $this|\SilntiBundle\Model\User
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\SilntiBundle\Model\User
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdUser($value);
                break;
            case 1:
                $this->setNom($value);
                break;
            case 2:
                $this->setPrenom($value);
                break;
            case 3:
                $this->setEmail($value);
                break;
            case 4:
                $this->setMdp($value);
                break;
            case 5:
                $this->setTel($value);
                break;
            case 6:
                $this->setDroit($value);
                break;
            case 7:
                $this->setPhoto($value);
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
        $keys = UserTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdUser($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNom($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPrenom($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEmail($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setMdp($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setTel($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDroit($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPhoto($arr[$keys[7]]);
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
     * @return $this|\SilntiBundle\Model\User The current object, for fluid interface
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
        $criteria = new Criteria(UserTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UserTableMap::COL_ID_USER)) {
            $criteria->add(UserTableMap::COL_ID_USER, $this->id_user);
        }
        if ($this->isColumnModified(UserTableMap::COL_NOM)) {
            $criteria->add(UserTableMap::COL_NOM, $this->nom);
        }
        if ($this->isColumnModified(UserTableMap::COL_PRENOM)) {
            $criteria->add(UserTableMap::COL_PRENOM, $this->prenom);
        }
        if ($this->isColumnModified(UserTableMap::COL_EMAIL)) {
            $criteria->add(UserTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(UserTableMap::COL_MDP)) {
            $criteria->add(UserTableMap::COL_MDP, $this->mdp);
        }
        if ($this->isColumnModified(UserTableMap::COL_TEL)) {
            $criteria->add(UserTableMap::COL_TEL, $this->tel);
        }
        if ($this->isColumnModified(UserTableMap::COL_DROIT)) {
            $criteria->add(UserTableMap::COL_DROIT, $this->droit);
        }
        if ($this->isColumnModified(UserTableMap::COL_PHOTO)) {
            $criteria->add(UserTableMap::COL_PHOTO, $this->photo);
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
        $criteria = ChildUserQuery::create();
        $criteria->add(UserTableMap::COL_ID_USER, $this->id_user);

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
        $validPk = null !== $this->getIdUser();

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
        return $this->getIdUser();
    }

    /**
     * Generic method to set the primary key (id_user column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdUser($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdUser();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \SilntiBundle\Model\User (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNom($this->getNom());
        $copyObj->setPrenom($this->getPrenom());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setMdp($this->getMdp());
        $copyObj->setTel($this->getTel());
        $copyObj->setDroit($this->getDroit());
        $copyObj->setPhoto($this->getPhoto());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getActualites() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addActualite($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEnseigners() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEnseigner($relObj->copy($deepCopy));
                }
            }

            $relObj = $this->getEtudiant();
            if ($relObj) {
                $copyObj->setEtudiant($relObj->copy($deepCopy));
            }

            foreach ($this->getFichiers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFichier($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNotes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNote($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPage($relObj->copy($deepCopy));
                }
            }

            $relObj = $this->getProf();
            if ($relObj) {
                $copyObj->setProf($relObj->copy($deepCopy));
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdUser(NULL); // this is a auto-increment column, so set to default value
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
     * @return \SilntiBundle\Model\User Clone of current object.
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
        if ('Actualite' == $relationName) {
            return $this->initActualites();
        }
        if ('Enseigner' == $relationName) {
            return $this->initEnseigners();
        }
        if ('Fichier' == $relationName) {
            return $this->initFichiers();
        }
        if ('Note' == $relationName) {
            return $this->initNotes();
        }
        if ('Page' == $relationName) {
            return $this->initPages();
        }
    }

    /**
     * Clears out the collActualites collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addActualites()
     */
    public function clearActualites()
    {
        $this->collActualites = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collActualites collection loaded partially.
     */
    public function resetPartialActualites($v = true)
    {
        $this->collActualitesPartial = $v;
    }

    /**
     * Initializes the collActualites collection.
     *
     * By default this just sets the collActualites collection to an empty array (like clearcollActualites());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initActualites($overrideExisting = true)
    {
        if (null !== $this->collActualites && !$overrideExisting) {
            return;
        }

        $collectionClassName = ActualiteTableMap::getTableMap()->getCollectionClassName();

        $this->collActualites = new $collectionClassName;
        $this->collActualites->setModel('\SilntiBundle\Model\Actualite');
    }

    /**
     * Gets an array of ChildActualite objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildActualite[] List of ChildActualite objects
     * @throws PropelException
     */
    public function getActualites(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collActualitesPartial && !$this->isNew();
        if (null === $this->collActualites || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collActualites) {
                // return empty collection
                $this->initActualites();
            } else {
                $collActualites = ChildActualiteQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collActualitesPartial && count($collActualites)) {
                        $this->initActualites(false);

                        foreach ($collActualites as $obj) {
                            if (false == $this->collActualites->contains($obj)) {
                                $this->collActualites->append($obj);
                            }
                        }

                        $this->collActualitesPartial = true;
                    }

                    return $collActualites;
                }

                if ($partial && $this->collActualites) {
                    foreach ($this->collActualites as $obj) {
                        if ($obj->isNew()) {
                            $collActualites[] = $obj;
                        }
                    }
                }

                $this->collActualites = $collActualites;
                $this->collActualitesPartial = false;
            }
        }

        return $this->collActualites;
    }

    /**
     * Sets a collection of ChildActualite objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $actualites A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setActualites(Collection $actualites, ConnectionInterface $con = null)
    {
        /** @var ChildActualite[] $actualitesToDelete */
        $actualitesToDelete = $this->getActualites(new Criteria(), $con)->diff($actualites);


        $this->actualitesScheduledForDeletion = $actualitesToDelete;

        foreach ($actualitesToDelete as $actualiteRemoved) {
            $actualiteRemoved->setUser(null);
        }

        $this->collActualites = null;
        foreach ($actualites as $actualite) {
            $this->addActualite($actualite);
        }

        $this->collActualites = $actualites;
        $this->collActualitesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Actualite objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Actualite objects.
     * @throws PropelException
     */
    public function countActualites(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collActualitesPartial && !$this->isNew();
        if (null === $this->collActualites || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collActualites) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getActualites());
            }

            $query = ChildActualiteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collActualites);
    }

    /**
     * Method called to associate a ChildActualite object to this object
     * through the ChildActualite foreign key attribute.
     *
     * @param  ChildActualite $l ChildActualite
     * @return $this|\SilntiBundle\Model\User The current object (for fluent API support)
     */
    public function addActualite(ChildActualite $l)
    {
        if ($this->collActualites === null) {
            $this->initActualites();
            $this->collActualitesPartial = true;
        }

        if (!$this->collActualites->contains($l)) {
            $this->doAddActualite($l);

            if ($this->actualitesScheduledForDeletion and $this->actualitesScheduledForDeletion->contains($l)) {
                $this->actualitesScheduledForDeletion->remove($this->actualitesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildActualite $actualite The ChildActualite object to add.
     */
    protected function doAddActualite(ChildActualite $actualite)
    {
        $this->collActualites[]= $actualite;
        $actualite->setUser($this);
    }

    /**
     * @param  ChildActualite $actualite The ChildActualite object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeActualite(ChildActualite $actualite)
    {
        if ($this->getActualites()->contains($actualite)) {
            $pos = $this->collActualites->search($actualite);
            $this->collActualites->remove($pos);
            if (null === $this->actualitesScheduledForDeletion) {
                $this->actualitesScheduledForDeletion = clone $this->collActualites;
                $this->actualitesScheduledForDeletion->clear();
            }
            $this->actualitesScheduledForDeletion[]= clone $actualite;
            $actualite->setUser(null);
        }

        return $this;
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
     * If this ChildUser is new, it will return
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
                    ->filterByUser($this)
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
     * @return $this|ChildUser The current object (for fluent API support)
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
            $enseignerRemoved->setUser(null);
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
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collEnseigners);
    }

    /**
     * Method called to associate a ChildEnseigner object to this object
     * through the ChildEnseigner foreign key attribute.
     *
     * @param  ChildEnseigner $l ChildEnseigner
     * @return $this|\SilntiBundle\Model\User The current object (for fluent API support)
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
        $enseigner->setUser($this);
    }

    /**
     * @param  ChildEnseigner $enseigner The ChildEnseigner object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
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
            $enseigner->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related Enseigners from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEnseigner[] List of ChildEnseigner objects
     */
    public function getEnseignersJoinCours(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEnseignerQuery::create(null, $criteria);
        $query->joinWith('Cours', $joinBehavior);

        return $this->getEnseigners($query, $con);
    }

    /**
     * Gets a single ChildEtudiant object, which is related to this object by a one-to-one relationship.
     *
     * @param  ConnectionInterface $con optional connection object
     * @return ChildEtudiant
     * @throws PropelException
     */
    public function getEtudiant(ConnectionInterface $con = null)
    {

        if ($this->singleEtudiant === null && !$this->isNew()) {
            $this->singleEtudiant = ChildEtudiantQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleEtudiant;
    }

    /**
     * Sets a single ChildEtudiant object as related to this object by a one-to-one relationship.
     *
     * @param  ChildEtudiant $v ChildEtudiant
     * @return $this|\SilntiBundle\Model\User The current object (for fluent API support)
     * @throws PropelException
     */
    public function setEtudiant(ChildEtudiant $v = null)
    {
        $this->singleEtudiant = $v;

        // Make sure that that the passed-in ChildEtudiant isn't already associated with this object
        if ($v !== null && $v->getUser(null, false) === null) {
            $v->setUser($this);
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
     * If this ChildUser is new, it will return
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
                    ->filterByUser($this)
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
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setFichiers(Collection $fichiers, ConnectionInterface $con = null)
    {
        /** @var ChildFichier[] $fichiersToDelete */
        $fichiersToDelete = $this->getFichiers(new Criteria(), $con)->diff($fichiers);


        $this->fichiersScheduledForDeletion = $fichiersToDelete;

        foreach ($fichiersToDelete as $fichierRemoved) {
            $fichierRemoved->setUser(null);
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
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collFichiers);
    }

    /**
     * Method called to associate a ChildFichier object to this object
     * through the ChildFichier foreign key attribute.
     *
     * @param  ChildFichier $l ChildFichier
     * @return $this|\SilntiBundle\Model\User The current object (for fluent API support)
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
        $fichier->setUser($this);
    }

    /**
     * @param  ChildFichier $fichier The ChildFichier object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
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
            $fichier->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related Fichiers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFichier[] List of ChildFichier objects
     */
    public function getFichiersJoinCours(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFichierQuery::create(null, $criteria);
        $query->joinWith('Cours', $joinBehavior);

        return $this->getFichiers($query, $con);
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
     * If this ChildUser is new, it will return
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
                    ->filterByUser($this)
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
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setNotes(Collection $notes, ConnectionInterface $con = null)
    {
        /** @var ChildNote[] $notesToDelete */
        $notesToDelete = $this->getNotes(new Criteria(), $con)->diff($notes);


        $this->notesScheduledForDeletion = $notesToDelete;

        foreach ($notesToDelete as $noteRemoved) {
            $noteRemoved->setUser(null);
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
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collNotes);
    }

    /**
     * Method called to associate a ChildNote object to this object
     * through the ChildNote foreign key attribute.
     *
     * @param  ChildNote $l ChildNote
     * @return $this|\SilntiBundle\Model\User The current object (for fluent API support)
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
        $note->setUser($this);
    }

    /**
     * @param  ChildNote $note The ChildNote object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
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
            $note->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related Notes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
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
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related Notes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildNote[] List of ChildNote objects
     */
    public function getNotesJoinSession(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildNoteQuery::create(null, $criteria);
        $query->joinWith('Session', $joinBehavior);

        return $this->getNotes($query, $con);
    }

    /**
     * Clears out the collPages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPages()
     */
    public function clearPages()
    {
        $this->collPages = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPages collection loaded partially.
     */
    public function resetPartialPages($v = true)
    {
        $this->collPagesPartial = $v;
    }

    /**
     * Initializes the collPages collection.
     *
     * By default this just sets the collPages collection to an empty array (like clearcollPages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPages($overrideExisting = true)
    {
        if (null !== $this->collPages && !$overrideExisting) {
            return;
        }

        $collectionClassName = PageTableMap::getTableMap()->getCollectionClassName();

        $this->collPages = new $collectionClassName;
        $this->collPages->setModel('\SilntiBundle\Model\Page');
    }

    /**
     * Gets an array of ChildPage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPage[] List of ChildPage objects
     * @throws PropelException
     */
    public function getPages(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPagesPartial && !$this->isNew();
        if (null === $this->collPages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPages) {
                // return empty collection
                $this->initPages();
            } else {
                $collPages = ChildPageQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPagesPartial && count($collPages)) {
                        $this->initPages(false);

                        foreach ($collPages as $obj) {
                            if (false == $this->collPages->contains($obj)) {
                                $this->collPages->append($obj);
                            }
                        }

                        $this->collPagesPartial = true;
                    }

                    return $collPages;
                }

                if ($partial && $this->collPages) {
                    foreach ($this->collPages as $obj) {
                        if ($obj->isNew()) {
                            $collPages[] = $obj;
                        }
                    }
                }

                $this->collPages = $collPages;
                $this->collPagesPartial = false;
            }
        }

        return $this->collPages;
    }

    /**
     * Sets a collection of ChildPage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $pages A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setPages(Collection $pages, ConnectionInterface $con = null)
    {
        /** @var ChildPage[] $pagesToDelete */
        $pagesToDelete = $this->getPages(new Criteria(), $con)->diff($pages);


        $this->pagesScheduledForDeletion = $pagesToDelete;

        foreach ($pagesToDelete as $pageRemoved) {
            $pageRemoved->setUser(null);
        }

        $this->collPages = null;
        foreach ($pages as $page) {
            $this->addPage($page);
        }

        $this->collPages = $pages;
        $this->collPagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Page objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Page objects.
     * @throws PropelException
     */
    public function countPages(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPagesPartial && !$this->isNew();
        if (null === $this->collPages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPages());
            }

            $query = ChildPageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collPages);
    }

    /**
     * Method called to associate a ChildPage object to this object
     * through the ChildPage foreign key attribute.
     *
     * @param  ChildPage $l ChildPage
     * @return $this|\SilntiBundle\Model\User The current object (for fluent API support)
     */
    public function addPage(ChildPage $l)
    {
        if ($this->collPages === null) {
            $this->initPages();
            $this->collPagesPartial = true;
        }

        if (!$this->collPages->contains($l)) {
            $this->doAddPage($l);

            if ($this->pagesScheduledForDeletion and $this->pagesScheduledForDeletion->contains($l)) {
                $this->pagesScheduledForDeletion->remove($this->pagesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPage $page The ChildPage object to add.
     */
    protected function doAddPage(ChildPage $page)
    {
        $this->collPages[]= $page;
        $page->setUser($this);
    }

    /**
     * @param  ChildPage $page The ChildPage object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removePage(ChildPage $page)
    {
        if ($this->getPages()->contains($page)) {
            $pos = $this->collPages->search($page);
            $this->collPages->remove($pos);
            if (null === $this->pagesScheduledForDeletion) {
                $this->pagesScheduledForDeletion = clone $this->collPages;
                $this->pagesScheduledForDeletion->clear();
            }
            $this->pagesScheduledForDeletion[]= clone $page;
            $page->setUser(null);
        }

        return $this;
    }

    /**
     * Gets a single ChildProf object, which is related to this object by a one-to-one relationship.
     *
     * @param  ConnectionInterface $con optional connection object
     * @return ChildProf
     * @throws PropelException
     */
    public function getProf(ConnectionInterface $con = null)
    {

        if ($this->singleProf === null && !$this->isNew()) {
            $this->singleProf = ChildProfQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleProf;
    }

    /**
     * Sets a single ChildProf object as related to this object by a one-to-one relationship.
     *
     * @param  ChildProf $v ChildProf
     * @return $this|\SilntiBundle\Model\User The current object (for fluent API support)
     * @throws PropelException
     */
    public function setProf(ChildProf $v = null)
    {
        $this->singleProf = $v;

        // Make sure that that the passed-in ChildProf isn't already associated with this object
        if ($v !== null && $v->getUser(null, false) === null) {
            $v->setUser($this);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id_user = null;
        $this->nom = null;
        $this->prenom = null;
        $this->email = null;
        $this->mdp = null;
        $this->tel = null;
        $this->droit = null;
        $this->photo = null;
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
            if ($this->collActualites) {
                foreach ($this->collActualites as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEnseigners) {
                foreach ($this->collEnseigners as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->singleEtudiant) {
                $this->singleEtudiant->clearAllReferences($deep);
            }
            if ($this->collFichiers) {
                foreach ($this->collFichiers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNotes) {
                foreach ($this->collNotes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPages) {
                foreach ($this->collPages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->singleProf) {
                $this->singleProf->clearAllReferences($deep);
            }
        } // if ($deep)

        $this->collActualites = null;
        $this->collEnseigners = null;
        $this->singleEtudiant = null;
        $this->collFichiers = null;
        $this->collNotes = null;
        $this->collPages = null;
        $this->singleProf = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserTableMap::DEFAULT_STRING_FORMAT);
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
