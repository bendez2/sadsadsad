<?php

declare(strict_types=1);

namespace longlang\phpkafka\Protocol\LeaveGroup;

use longlang\phpkafka\Protocol\AbstractStruct;
use longlang\phpkafka\Protocol\ProtocolField;

class MemberIdentity extends AbstractStruct
{
    /**
     * The member ID to remove from the group.
     *
     * @var string
     */
    protected $memberId = '';

    /**
     * The group instance ID to remove from the group.
     *
     * @var string|null
     */
    protected $groupInstanceId = null;

    public function __construct()
    {
        if (!isset(self::$maps[self::class])) {
            self::$maps[self::class] = [
                new ProtocolField('memberId', 'string', false, [3, 4], [4], [], [], null),
                new ProtocolField('groupInstanceId', 'string', false, [3, 4], [4], [3, 4], [], null),
            ];
            self::$taggedFieldses[self::class] = [
            ];
        }
    }

    public function getFlexibleVersions(): array
    {
        return [4];
    }

    public function getMemberId(): string
    {
        return $this->memberId;
    }

    public function setMemberId(string $memberId): self
    {
        $this->memberId = $memberId;

        return $this;
    }

    public function getGroupInstanceId(): ?string
    {
        return $this->groupInstanceId;
    }

    public function setGroupInstanceId(?string $groupInstanceId): self
    {
        $this->groupInstanceId = $groupInstanceId;

        return $this;
    }
}
