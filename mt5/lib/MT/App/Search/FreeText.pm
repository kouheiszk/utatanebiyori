# Movable Type (r) (C) 2001-2010 Six Apart, Ltd. All Rights Reserved.
# This code cannot be redistributed without permission from www.sixapart.com.
# For more information, consult your Movable Type license.
#
# $Id: FreeText.pm 4196 2009-09-04 07:46:50Z takayama $

package MT::App::Search::FreeText;

use strict;
use base qw( MT::App::Search );
use MT::ObjectDriver::SQL qw( :constants );

sub id { 'new_search' }

sub query_parse {
    my $app = shift;
    my ( %columns ) = @_;

    my @column_names = keys %columns;

    my $args = {
      'freetext' => {
        columns       => \@column_names,
        search_string => $app->{search_string}
      }
    };
    { args => $args };
}

1;
__END__
