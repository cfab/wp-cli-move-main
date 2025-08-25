# New Features: Plugins, MU-Plugins, and Themes Sync

This enhancement adds support for syncing WordPress plugins, mu-plugins, and themes between environments using the wp-cli-move package.

## New Command Line Options

The following new options have been added to both `pull` and `push` commands:

- `--plugins`: Sync only the plugins folder
- `--mu-plugins`: Sync only the mu-plugins folder
- `--themes`: Sync only the themes folder

## Usage Examples

### Pull plugins from staging environment

```bash
wp move pull staging --plugins
```

### Push themes to production environment

```bash
wp move push production --themes
```

### Sync only plugins and themes (no database or uploads)

```bash
wp move pull staging --plugins --themes
```

### Sync everything (existing behavior remains unchanged)

```bash
wp move pull staging
```

### Dry run to see what would be synced

```bash
wp move pull staging --plugins --themes --dry-run
```

## Implementation Details

### New Constants

- `DATA_TYPE_PLUGINS = 'plugins'`
- `DATA_TYPE_MU_PLUGINS = 'mu-plugins'`
- `DATA_TYPE_THEMES = 'themes'`

### New Methods in MoveCommand

- `sync_plugins()`: Syncs WordPress plugins directory
- `sync_mu_plugins()`: Syncs WordPress mu-plugins directory
- `sync_themes()`: Syncs WordPress themes directory
- `sync_directory()`: Generic directory sync method using rsync

### New Methods in Alias Model

- `get_plugins_path()`: Returns the WordPress plugins directory path
- `get_mu_plugins_path()`: Returns the WordPress mu-plugins directory path
- `get_themes_path()`: Returns the WordPress themes directory path

## How It Works

1. The new sync methods follow the same pattern as the existing `sync_uploads()` method
2. Each method determines the source and target paths using WordPress constants:
   - Plugins: `WP_PLUGIN_DIR`
   - MU-Plugins: `WPMU_PLUGIN_DIR`
   - Themes: `get_theme_root()`
3. Files are transferred using rsync with the same default arguments as uploads
4. The sync is bidirectional based on the command (pull vs push)

## Backward Compatibility

All existing functionality remains unchanged. When no specific data type flags are provided, the command will sync all data types (database, uploads, plugins, mu-plugins, themes) as before.
