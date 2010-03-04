<?php
/*
 * StatusNet - the distributed open-source microblogging tool
 * Copyright (C) 2010, StatusNet, Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * @package OStatusPlugin
 * @maintainer James Walker <james@status.net>
 */

if (!defined('STATUSNET')) { exit(1); }

class UserxrdAction extends XrdAction
{

    function prepare($args)
    {
        parent::prepare($args);

        $this->uri = $this->trimmed('uri');
        $acct = Discovery::normalize($this->uri);

        list($nick, $domain) = explode('@', substr(urldecode($acct), 5));
        $nick = common_canonical_nickname($nick);

        $this->user = User::staticGet('nickname', $nick);
        if (!$this->user) {
            $this->clientError(_('No such user.'), 404);
            return false;
        }

        return true;
    }
}