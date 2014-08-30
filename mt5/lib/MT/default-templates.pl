# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: default-templates.pl 4196 2009-09-04 07:46:50Z takayama $

package MT::default_templates;

use strict;
require MT::DefaultTemplates;

delete $INC{'MT/default-templates.pl'};

MT::DefaultTemplates->templates;
