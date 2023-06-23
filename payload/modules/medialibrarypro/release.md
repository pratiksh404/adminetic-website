## Releasing a new version of the package

Commit and push the changes to the repository and tag a new release.

### If the JS components were changed

A commit will automatically trigger the bundle steps, so the changes will be included in the satis release automatically.

After pushing, run `yarn publish-all` and choose the next version to publish them to the GitHub Package Registry too.
