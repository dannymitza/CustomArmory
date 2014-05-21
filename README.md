CustomArmory
============

A custom armory for SkyFireEMU (and TrinityCore)

It works by quering your database, and your DBC files to get stats and other useful information about items and such on your server.

To install this (to test, that is... it's not nearly finished yet) change the config.php

`$set['type'] = 0` Your emulator. 0 for SkyFireEMU and 1 for TrinityCore.

`$set['db_pass'] = ''` Your database password.

`$set['db_user'] = ''` Your database user.

`$set['db_world'] = ''` Your world database name.

`$set['db_conn'] = ''` Your database address.

`$set['db_port'] = 3306` Your database port.

`$set['db_characters'] = 'characters'` Your character database.