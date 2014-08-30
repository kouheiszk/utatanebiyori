#!/usr/bin/perl -w

# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: mt-cp.cgi 116653 2009-12-14 09:56:08Z auno $

use strict;
use lib 'addons/Community.pack/lib';
use lib 'addons/Commercial.pack/lib';
use lib $ENV{MT_HOME} ? "$ENV{MT_HOME}/lib" : 'lib';
use MT::Bootstrap App => 'MT::App::Community';
