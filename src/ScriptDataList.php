<?hh
/**
 * Copyright (c) 2015-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 */

final class ScriptDataList implements JsonSerializable {
  const type TData = (string, string, vec<(string, mixed)>);
  private vec<self::TData> $scriptData = vec[];
  public function append(self::TData $script_data): void {
    $this->scriptData[] = $script_data;
  }
  public function jsonSerialize(): vec<self::TData> {
    return $this->scriptData;
  }
}