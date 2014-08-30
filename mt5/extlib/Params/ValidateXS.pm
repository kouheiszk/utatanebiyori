# ======================================================================
#
# Copyright (C) 2000-2003 Paul Kulchenko (paulclinger@yahoo.com)
# SOAP::Lite is free software; you can redistribute it
# and/or modify it under the same terms as Perl itself.
#
# $Id: Schema.pod 98 2007-10-09 09:41:55Z kutterma $
#
# ======================================================================

=pod

=head1 NAME

SOAP::Schema - provides an umbrella for the way in which SOAP::Lite manages service description schemas

=head1 DESCRIPTION

This class provides an umbrella for the way in which SOAP::Lite manages service description schemas. Currently, the only support present is for the Web Services Description Language (WSDL). This is another of the classes not generally designed to be directly instantiated by an application, though it can be if so desired. 

=head1 METHODS

=over

=item new(optional key/value pairs)

    $schema = SOAP::Schema->new(parse => $schema_uri);

This is the class constructor. With no arguments, it creates a blank object of the class. Any arguments that are passed are treated as key/value pairs in which the key represents one of the methods described here, and the value is what gets passed when the method itself gets invoked.

=item parse(service description URI)

    $schema->parse('http://schemas.w3.org/soap.wsdl');

Parses the internal representation of the service description prior to the generation of stub routines to provide method-like access to the remote services.

=item access(service description URI)

    $schema->access('http://soap.org/service.wsdl');

Loads the specified service description from the given URL, using the current value of the schema accessor if none is provided. The full content of the URL is returned on success, or an exception is thrown (via C<die>) on error.

=item load

    $schema->load;

Takes the internal representation of the service and generates code stubs for the remote methods, allowing them to be called as local object methods. Stubs are generated for all the functions declared in the WSDL description with this call because it's enough of a class framework to allow for basic object creation for use as handles.

=item schema

    $current_schema = $schema->schema;

Gets (or sets) the current schema representation to be used by this object. The value to be passed when setting this is just the URI of the schema. This gets passed to other methods such as access for loading the actual content.

=item services

    $hashref = $schema->services;

Gets or sets the services currently stored on the object. The services are kept as a hash reference, whose keys and values are the list of returned values from the WSDL parser. Keys represent the names of the services themselves (names have been normalized into Perl-compatible identifiers), with values that are also hash references to the internal representation of the service itself.

=item stub

Returns the autogenerated Perl code as a string. This code is generated from the WSDL provided by the C<service> method call. The code contains a package definition for the service being called.

    my $client = SOAP::Lite->new;
    my $code = $client->service($WSDL_URL)->stub;
    open FILE,">ServicePackage.pm";
    print FILE $code;
    close FILE;

=item cache_dir

Sets/retrieves the value of the directory where generated stubs will be cached. If C<cache_dir> is null, then no caching will be performed.

    my $client = SOAP::Lite->new;
    my $code = $client->cache_dir("/tmp")->service($WSDL_URL)->stub;

If C<cache_dir> is undefined, no caching will take place.

=item cache_ttl

Sets/retrieves the value of the time to live (in seconds) for cached files. This is only relevant when used in conjunction with C<cache_dir>.

If C<cache_ttl> is set to 0, the cache will never expire. Files will have to be removed manually in order for the cache to be refreshed.

    my $client = SOAP::Lite->new;
    my $code = $client->cache_ttl(3600)->cache_dir("/tmp")->service($WSDL_URL)->stub;

The default time to live is 0.

=item useragent(LWP::UserAgent)

    my $client = SOAP::Lite->new;
    $ua = $client->schema->useragent;
    $ua->agent("Fubar! 0.1");
    my $response = $client->service("http://localhost/some.wsdl")
                          ->someMethod("Foo");
    
Gets or sets the classes UserAgent used for retrieving schemas over the web. 
This allows users to have direct access to the UserAgent so that they may control
the credentials passed to a remote server, or the specific configuration of their
HTTP agent.

=back

=head1 SOAP::Schema::WSDL

At present, the SOAP::Lite toolkit supports only loading of service descriptions in the WSDL syntax. This class manages the parsing and storing of these service specifications. As a general rule, this class should be even less likely to be used directly by an application because its presence should be completely abstracted by the previous class (SOAP::Schema). None of the methods are defined here; the class is only mentioned for sake of reference.

=head1 ACKNOWLEDGEMENTS

Special thanks to O'Reilly publishing which has graciously allowed SOAP::Lite to republish and redistribute large excerpts from I<Programming Web Services with Perl>, mainly the SOAP::Lite reference found in Appendix B.

=head1 COPYRIGHT

Copyright (C) 2000-2004 Paul Kulchenko. All rights reserved.

This library is free software; you can redistribute it and/or modify
it under the same terms as Perl itself.

=head1 AUTHORS

Paul Kulchenko (paulclinger@yahoo.com)

Randy J. Ray (rjray@blackperl.com)

Byrne Reese (byrne@majordojo.com)

=cut





