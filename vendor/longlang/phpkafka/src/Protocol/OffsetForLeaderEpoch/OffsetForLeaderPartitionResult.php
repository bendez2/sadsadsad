<?php

declare(strict_types=1);

namespace longlang\phpkafka\Protocol\OffsetForLeaderEpoch;

use longlang\phpkafka\Protocol\AbstractStruct;
use longlang\phpkafka\Protocol\ProtocolField;

class OffsetForLeaderPartitionResult extends AbstractStruct
{
    /**
     * The error code 0, or if there was no error.
     *
     * @var int
     */
    protected $errorCode = 0;

    /**
     * The partition index.
     *
     * @var int
     */
    protected $partitionIndex = 0;

    /**
     * The leader epoch of the partition.
     *
     * @var int
     */
    protected $leaderEpoch = -1;

    /**
     * The end offset of the epoch.
     *
     * @var int
     */
    protected $endOffset = 0;

    public function __construct()
    {
        if (!isset(self::$maps[self::class])) {
            self::$maps[self::class] = [
                new ProtocolField('errorCode', 'int16', false, [0, 1, 2, 3], [], [], [], null),
                new ProtocolField('partitionIndex', 'int32', false, [0, 1, 2, 3], [], [], [], null),
                new ProtocolField('leaderEpoch', 'int32', false, [1, 2, 3], [], [], [], null),
                new ProtocolField('endOffset', 'int64', false, [0, 1, 2, 3], [], [], [], null),
            ];
            self::$taggedFieldses[self::class] = [
            ];
        }
    }

    public function getFlexibleVersions(): array
    {
        return [];
    }

    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    public function setErrorCode(int $errorCode): self
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    public function getPartitionIndex(): int
    {
        return $this->partitionIndex;
    }

    public function setPartitionIndex(int $partitionIndex): self
    {
        $this->partitionIndex = $partitionIndex;

        return $this;
    }

    public function getLeaderEpoch(): int
    {
        return $this->leaderEpoch;
    }

    public function setLeaderEpoch(int $leaderEpoch): self
    {
        $this->leaderEpoch = $leaderEpoch;

        return $this;
    }

    public function getEndOffset(): int
    {
        return $this->endOffset;
    }

    public function setEndOffset(int $endOffset): self
    {
        $this->endOffset = $endOffset;

        return $this;
    }
}
