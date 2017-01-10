Troubleshooting
===============

Error: "Segmentation fault"
^^^^^^^^^^^^^^^^^^^^^^^^^^^

If the script fails with the error 'segmentation fault', please try rerunning it. I've still not figured out why it occurs but it is infrequent.

Error: "User cloudmunch doesn't exist"
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This can occur if for some reason the user you created is no longer present on the host. Again, this occurs infrequently and the cause is not clear. Just redo the `installation steps <https://github.com/cloudmunch/Install>`__ to do with user creation. You may also need to reapply owner permissions to the 'platform' and 'domain' folders.

Error: "Error occurred while performing trigger on interface cmexecutor 
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

"Interface system url http://<address>/executorservice/api host could not be resolved. Please check configurations/settings"

This occurs

