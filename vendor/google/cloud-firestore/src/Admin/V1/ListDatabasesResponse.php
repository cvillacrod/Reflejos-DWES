<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/firestore/admin/v1/firestore_admin.proto

namespace Google\Cloud\Firestore\Admin\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * The list of databases for a project.
 *
 * Generated from protobuf message <code>google.firestore.admin.v1.ListDatabasesResponse</code>
 */
class ListDatabasesResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * The databases in the project.
     *
     * Generated from protobuf field <code>repeated .google.firestore.admin.v1.Database databases = 1;</code>
     */
    private $databases;
    /**
     * In the event that data about individual databases cannot be listed they
     * will be recorded here.
     * An example entry might be: projects/some_project/locations/some_location
     * This can happen if the Cloud Region that the Database resides in is
     * currently unavailable.  In this case we can't fetch all the details about
     * the database. You may be able to get a more detailed error message
     * (or possibly fetch the resource) by sending a 'Get' request for the
     * resource or a 'List' request for the specific location.
     *
     * Generated from protobuf field <code>repeated string unreachable = 3;</code>
     */
    private $unreachable;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type array<\Google\Cloud\Firestore\Admin\V1\Database>|\Google\Protobuf\Internal\RepeatedField $databases
     *           The databases in the project.
     *     @type array<string>|\Google\Protobuf\Internal\RepeatedField $unreachable
     *           In the event that data about individual databases cannot be listed they
     *           will be recorded here.
     *           An example entry might be: projects/some_project/locations/some_location
     *           This can happen if the Cloud Region that the Database resides in is
     *           currently unavailable.  In this case we can't fetch all the details about
     *           the database. You may be able to get a more detailed error message
     *           (or possibly fetch the resource) by sending a 'Get' request for the
     *           resource or a 'List' request for the specific location.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Firestore\Admin\V1\FirestoreAdmin::initOnce();
        parent::__construct($data);
    }

    /**
     * The databases in the project.
     *
     * Generated from protobuf field <code>repeated .google.firestore.admin.v1.Database databases = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getDatabases()
    {
        return $this->databases;
    }

    /**
     * The databases in the project.
     *
     * Generated from protobuf field <code>repeated .google.firestore.admin.v1.Database databases = 1;</code>
     * @param array<\Google\Cloud\Firestore\Admin\V1\Database>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setDatabases($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\Firestore\Admin\V1\Database::class);
        $this->databases = $arr;

        return $this;
    }

    /**
     * In the event that data about individual databases cannot be listed they
     * will be recorded here.
     * An example entry might be: projects/some_project/locations/some_location
     * This can happen if the Cloud Region that the Database resides in is
     * currently unavailable.  In this case we can't fetch all the details about
     * the database. You may be able to get a more detailed error message
     * (or possibly fetch the resource) by sending a 'Get' request for the
     * resource or a 'List' request for the specific location.
     *
     * Generated from protobuf field <code>repeated string unreachable = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getUnreachable()
    {
        return $this->unreachable;
    }

    /**
     * In the event that data about individual databases cannot be listed they
     * will be recorded here.
     * An example entry might be: projects/some_project/locations/some_location
     * This can happen if the Cloud Region that the Database resides in is
     * currently unavailable.  In this case we can't fetch all the details about
     * the database. You may be able to get a more detailed error message
     * (or possibly fetch the resource) by sending a 'Get' request for the
     * resource or a 'List' request for the specific location.
     *
     * Generated from protobuf field <code>repeated string unreachable = 3;</code>
     * @param array<string>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setUnreachable($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->unreachable = $arr;

        return $this;
    }

}
